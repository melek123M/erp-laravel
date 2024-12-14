<div class="container">
    <h1>Liste des Clients</h1>
    <button id="btn-add-client" class="btn btn-primary mb-3">Ajouter un Client</button>
    <table id="clients-table" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Actions</th>
            </tr>
        </thead>
    </table>
</div>

<!-- Modal d'ajout -->
<div class="modal fade" id="addClientModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form id="add-client-form">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ajouter un Client</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Téléphone</label>
                        <input type="text" class="form-control" id="phone" name="phone" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
$(document).ready(function () {
    const table = $('#clients-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('clients.data') }}",
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'phone', name: 'phone' },
            { 
                data: null, 
                render: function (data) {
                    return `
                        <button class="btn btn-sm btn-warning btn-edit" data-id="${data.id}">Modifier</button>
                        <button class="btn btn-sm btn-danger btn-delete" data-id="${data.id}">Supprimer</button>
                    `;
                }
            }
        ]
    });

    // Ouvrir le modal d'ajout
    $('#btn-add-client').on('click', function () {
        $('#add-client-form')[0].reset();
        $('#addClientModal').modal('show');
    });

    // Soumettre le formulaire en AJAX
    $('#add-client-form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: "{{ route('clients.store') }}",
            method: "POST",
            data: $(this).serialize(),
            success: function (response) {
                $('#addClientModal').modal('hide');
                table.ajax.reload(); // Rafraîchir le tableau
                alert('Client ajouté avec succès !');
            },
            error: function (xhr) {
                alert('Erreur lors de l\'ajout du client.');
            }
        });
    });
});
</script>
