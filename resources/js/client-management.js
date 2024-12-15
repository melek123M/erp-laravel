import $ from 'jquery';
import 'datatables.net';
import toastr from 'toastr';

$(document).ready(function () {
    if (!window.routes) {
        console.error('Routes non définies');
        return;
    }

    function handleClientAction(form, route, successMessage, errorMessage) {
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
                    $('#addClientModal').hide();
                    $('#editClientModal').hide();

                    $('#clients-table').DataTable().ajax.reload();
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
    $('#addClientForm').on('submit', function (e) {
        e.preventDefault();
        handleClientAction(
            $(this),
            window.routes.clientStore,
            'Client ajouté avec succès',
            'Erreur lors de l\'ajout du client'
        ).then(() => {
            console.log('Client ajouté avec succès');
        }).catch(() => {
            console.log('Erreur lors de l\'ajout du client');
        });
    });



    //Édition de client
    $(document).on('click', '.edit-client', function () {

        var clientId = $(this).data('id');
        $.ajax({
            url: `/clients/${clientId}/edit`,
            method: 'GET',
            success: function (response) {
                $('#clientId').val(response.id);
                $('#edit_name').val(response.name);
                $('#edit_email').val(response.email);
                $('#edit_phone').val(response.phone);
                const editModal = new bootstrap.Modal(document.getElementById('editClientModal'));
                editModal.show();
            },
            error: function () {
                toastr.error('Impossible de charger les informations du client');
            }
        });
    });
    
    //Mise à jour de client
    $('#editClientForm').on('submit', function (e) {
        e.preventDefault();
        var clientId = $('#clientId').val();
        handleClientAction(
            $(this),
            `/clients/${clientId}`,
            'Client modifié avec succès',
            'Erreur lors de la modification du client'
        );
    });

    //Suppression de client
    var clientToDelete = null;
    $(document).on('click', '.delete-client', function () {
        clientToDelete = $(this).data('id');
        const deletModal = new bootstrap.Modal(document.getElementById('deleteClientModal'));
        deletModal.show();
    });

    $('#deleteClientBtn').on('click', function () {
        $('#deleteClientModal').hide();
        const backdrop = document.querySelector('.modal-backdrop');
        if (backdrop) {
            backdrop.remove();
        }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': '5GvkDiXrqiJy7YZcp7rZdB5JKpO1FYjyc2SXNfQd'
            },
            url: `/clients/${clientToDelete}`,
            method: 'DELETE',
            success: function (response) {
                $('#clients-table').DataTable().ajax.reload();
                toastr.success('Client supprimé avec succès');
            },
            error: function () {
                toastr.error('Erreur lors de la suppression du client');
            }
        });
    });

    // Initialisation de DataTables
    if ($('#clients-table').length) {
        $('#clients-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: window.routes.clientData,
            columns: [
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'phone', name: 'phone' },
                { data: 'action', orderable: false, searchable: false }
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
            // Configuration Bootstrap
            dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>' +
                '<"row"<"col-sm-12"tr>>' +
                '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
            renderer: 'bootstrap',
            language: {
                // Personnalisez les libellés si nécessaire
                lengthMenu: "Afficher _MENU_ entrées",
                search: "Rechercher:",
                info: "Affichage de _START_ à _END_ sur _TOTAL_ entrées"
            }
        });
    }
});