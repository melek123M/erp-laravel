import $ from 'jquery';
import 'datatables.net';
import toastr from 'toastr';

$(document).ready(function () {
    if (!window.routes) {
        console.error('Routes non définies');
        return;
    }

    function handlefactureAction(form, route, successMessage, errorMessage) {

        return new Promise(function (resolve, reject) {
            $.ajax({
                url: route,
                method: form.attr('method'),
                data: form.serialize(),
                success: function (response) {
                    const backdrop = document.querySelector('.modal-backdrop');
                    if (backdrop) {
                        backdrop.remove();
                    }
                    const backdrop1 = document.querySelector('.modal-backdrop');
                    if (backdrop1) {
                        backdrop1.remove();
                    }
                    const backdrop2 = document.querySelector('.modal-backdrop');
                    if (backdrop2) {
                        backdrop2.remove();
                    }
                    $('#addFactureModal').hide();
                    $('#editFactureModal').hide();
                    $('#invoices-table').DataTable().ajax.reload();
                    toastr.success(successMessage);
                    resolve(response);
                },
                error: function (xhr) {
                    var errors = xhr.responseJSON.errors;
                    if (errors) {
                        Object.keys(errors).forEach(function (key) {
                            toastr.error(errors[key][0]);
                        });
                    } else {
                        toastr.error(errorMessage);
                    }
                    reject(xhr);
                }
            });
        });
    }
    $('#addFactureForm').on('submit', function (e) {
        e.preventDefault();
        handlefactureAction(
            $(this),
            window.routes.storeInvoice,
            'facture ajouté avec succès',
            'Erreur lors de l\'ajout du facture'
        ).then(() => {
            console.log('facture ajouté avec succès');
        }).catch(() => {
            console.log('Erreur lors de l\'ajout du facture');
        });
    });


    $(document).on('click', '.edit-facture', function () {

        var factureId = $(this).data('id');
        console.log(factureId);

        $.ajax({
            url: `/factures/${factureId}/edit`,
            method: 'GET',
            success: function (response) {
                $('#factureId').val(response.id);
                $('#edit_due_date').val(response.due_date);
                $('#edit_amount').val(response.amount);
                $('#edit_status').val(response.status);
                const editModal = new bootstrap.Modal(document.getElementById('editFactureModal'));
                editModal.show();
            },
            error: function () {
                toastr.error('Impossible de charger les informations du factur');
            }
        });
    });

    $('#editFactureForm').on('submit', function (e) {
        e.preventDefault();
        var factureId = $('#factureId').val();
        handlefactureAction(
            $(this),
            `/factures/${factureId}`,
            'facture modifié avec succès',
            'Erreur lors de la modification du facture'
        );
    });

    var factureToDelete = null;
    $(document).on('click', '.delete-facture', function () {
        factureToDelete = $(this).data('id');
        const deletModal = new bootstrap.Modal(document.getElementById('deleteFactureModal'));
        deletModal.show();
    });

    $('#deleteFactureBtn').on('click', function () {
        $('#deleteFactureModal').hide();
        const backdrop = document.querySelector('.modal-backdrop');
        if (backdrop) {
            backdrop.remove();
        }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': '5GvkDiXrqiJy7YZcp7rZdB5JKpO1FYjyc2SXNfQd'
            },
            url: `/factures/${factureToDelete}`,
            method: 'DELETE',
            success: function (response) {
                $('#invoices-table').DataTable().ajax.reload();
                toastr.success('facture supprimé avec succès');
            },
            error: function () {
                toastr.error('Erreur lors de la suppression du facture');
            }
        });
    });

    $('#loadUnpaidInvoices').on('click', function () {
        fetch(window.routes.unpaidInvoice)
            .then(response => response.json())
            .then(data => {
                const tableBody = document.querySelector('#unpaid-invoices-table tbody');
                tableBody.innerHTML = '';
                if (data.length === 0) {
                    tableBody.innerHTML =
                        `<tr><td colspan="3" class="text-center">Aucune facture impayée</td></tr>`;
                } else {
                    data.forEach(invoice => {
                        tableBody.innerHTML += `
                                    <tr>
                                        <td>${invoice.amount}</td>
                                        <td>${invoice.due_date}</td>
                                        <td>${invoice.status}</td>
                                    </tr>
                                `;
                    });
                }
            })
            .catch(error => console.error('Erreur lors du chargement des factures impayées :',
                error));

    });

    $('#calculateUnpaidTotal').on('click', function () {
        
        fetch(window.routes.totalUnpaid)
            .then(response => response.json())
            .then(data => {
                const unpaidTotalContainer = document.getElementById('unpaidTotalContainer');
                const unpaidTotalAmount = document.getElementById('unpaidTotalAmount');

                unpaidTotalAmount.textContent = data.total || 0;
                unpaidTotalContainer.style.display = 'block';
            })
            .catch(error => console.error('Erreur lors du calcul du total des factures impayées :', error));
    });

    if ($('#invoices-table').length) {

        $('#invoices-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: window.routes.listeFactures,
            columns: [
                { data: 'amount', name: 'amount' },
                { data: 'due_date', name: 'due_date' },
                { data: 'status', name: 'status' },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ],
            pagingType: "full_numbers",
            language: {
                paginate: {
                    first: "Premier",
                    last: "Dernier",
                    next: "Suivant",
                    previous: "Précédent"
                }
            },
            dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>' +
                '<"row"<"col-sm-12"tr>>' +
                '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
            renderer: 'bootstrap',
            language: {
                lengthMenu: "Afficher _MENU_ entrées",
                search: "Rechercher:",
                info: "Affichage de _START_ à _END_ sur _TOTAL_ entrées"
            },
            order: [[0, 'asc']]
        });
    }

});