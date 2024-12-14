<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table table-borderless" id="students-table">
            <thead class="thead-bg-dark">
                <tr>
                    <th class="sortable" data-order="asc">↑↓</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Numéro Sécurité Sociale</th>
                    <th>adresse</th>
                    <th>Code postal</th>
                    <th>Nom établissement</th>
                    <th colspan="3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $i => $student)
                    <tr>
                        <td><strong>{{ $i + 1 }}</strong></td>
                        <td>{!! isset($student->name) ? $student->name : '' !!}</td>
                        <td>{!! isset($student->last_name) ? $student->last_name : '' !!}</td>
                        <td>{!! isset($student->email) ? $student->email : '' !!}</td>
                        <td>{!! isset($student->phone) ? $student->phone : '' !!}</td>
                        <td>{!! isset($student->num_security_social) ? $student->num_security_social : '' !!}</td>
                        <td>{!! isset($student->adress) ? $student->adress : '' !!}</td>
                        <td>{!! isset($student->zip_code) ? $student->zip_code : '' !!}</td>
                        <td>{!! isset($student->establishments->name) ? $student->establishments->name : '' !!}</td>
                        <td style="width: 120px">

                            <div class="d-flex">

                                <a href="{{ route('students.show', [$student->id]) }}" class='btn-view btn-xs'>
                                <svg class="icon-view" stroke-linejoin="round" stroke-linecap="round" fill="none" stroke-width="2" stroke="#B5BAC1" height="18" width="18" viewBox="0 0 24 24">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle r="3" cy="12" cx="12"></circle>
                                </svg>
                                <span class="tooltip">Voir plus</span>
                                </a>
                                <a href="{{ route('students.edit', [$student->id]) }}" class='btn-edit btn-xs'>
                                <svg class="svg-icon" fill="none" height="18" viewBox="0 0 24 24" width="18" xmlns="http://www.w3.org/2000/svg">
                                    <g stroke="#B5BAC1" stroke-linecap="round" stroke-width="2">
                                        <path d="m20 20h-16"></path>
                                        <path clip-rule="evenodd" d="m14.5858 4.41422c.781-.78105 2.0474-.78105 2.8284 0 .7811.78105.7811 2.04738 0 2.82843l-8.28322 8.28325-3.03046.202.20203-3.0304z" fill-rule="evenodd"></path>
                                    </g>
                                </svg>
                                <span class="tooltip">Modifier</span>
                                </a>

                                {!! Form::open([
                                    'route' => ['students.destroy', $student->id],
                                    'method' => 'delete',
                                ]) !!}
                                @csrf
                                <button type="button" class="btn-delete btn-xs" onclick="confirmDelete(this)">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" width="16" height="16" viewBox="0 0 50 59" class="bin">
                                <path fill="#B5BAC1" d="M0 7.5C0 5.01472 2.01472 3 4.5 3H45.5C47.9853 3 50 5.01472 50 7.5V7.5C50 8.32843 49.3284 9 48.5 9H1.5C0.671571 9 0 8.32843 0 7.5V7.5Z"></path>
                                <path fill="#B5BAC1" d="M17 3C17 1.34315 18.3431 0 20 0H29.3125C30.9694 0 32.3125 1.34315 32.3125 3V3H17V3Z"></path>
                                <path fill="#B5BAC1" d="M2.18565 18.0974C2.08466 15.821 3.903 13.9202 6.18172 13.9202H43.8189C46.0976 13.9202 47.916 15.821 47.815 18.0975L46.1699 55.1775C46.0751 57.3155 44.314 59.0002 42.1739 59.0002H7.8268C5.68661 59.0002 3.92559 57.3155 3.83073 55.1775L2.18565 18.0974ZM18.0003 49.5402C16.6196 49.5402 15.5003 48.4209 15.5003 47.0402V24.9602C15.5003 23.5795 16.6196 22.4602 18.0003 22.4602C19.381 22.4602 20.5003 23.5795 20.5003 24.9602V47.0402C20.5003 48.4209 19.381 49.5402 18.0003 49.5402ZM29.5003 47.0402C29.5003 48.4209 30.6196 49.5402 32.0003 49.5402C33.381 49.5402 34.5003 48.4209 34.5003 47.0402V24.9602C34.5003 23.5795 33.381 22.4602 32.0003 22.4602C30.6196 22.4602 29.5003 23.5795 29.5003 24.9602V47.0402Z" clip-rule="evenodd" fill-rule="evenodd"></path>
                                <path fill="#B5BAC1" d="M2 13H48L47.6742 21.28H2.32031L2 13Z"></path>
                            </svg>

                            <span class="tooltip">Supprimer</span>
                                </button>
                                {!! Form::close() !!}
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="card-footer clearfix">
        <div class="float-right">
            @include('adminlte-templates::common.paginate', ['records' => $students])
        </div>
    </div>
</div>
<script>
   function confirmDelete(button) {
    Swal.fire({
        text: "Êtes-vous sûr de vouloir supprimer cet étudiant ?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#161B33",
        cancelButtonColor: "#ec907b",
        confirmButtonText: "Supprimer",
        cancelButtonText: "Annuler"
    }).then((result) => {
        if (result.isConfirmed) {
            // Find the form and submit it
            var form = button.closest('form');
            if (form) {
                form.submit();
            }

            Swal.fire({
                title: "Supprimé!",
                text: "Étudiant a été supprimé.",
                icon: "success"
            });
        }
    });
}
</script>