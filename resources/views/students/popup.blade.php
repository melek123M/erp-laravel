<!-- Le modèle de popup amélioré -->

@extends('layouts.app')

@section('content')
    
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>
                        Ajouter étudiant
                    </h1>
                </div>
            </div>
        </div>
    </section>


    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">
            {!! Form::open(['route' => 'student_to_establishment']) !!}

            <div class="card-body">
                <div style="border: 2px solid orange; padding: 10px; text-align: center;">
                    Cet étudiant a déjà effectué l'inscription, êtes-vous sûr qu'il est de cet établissement ?
                    <button type="submit" name="action" value="ok" class="btn btn-default">OK</button>
                </div>
                <div class="row">
                    @include('students.fields', [
                        'civilities' => $civilities,
                        'promotions' => $promotions,
                        'status' => $status,
                        'classes' => $classes,
                        'contrats' => $contrats,
                        'establishments' => $establishments,
                    ])
                </div>
            </div>
            
            <div class="card-footer">
                {!! Form::submit('Enregistrer', ['name' => 'action', 'value' => 'save', 'class' => 'btn btn-primary']) !!}
                <a href="{{ route('students.index') }}" class="btn btn-default"> Retour</a>
            </div>
            
            {!! Form::close() !!}
            

        </div>
    </div>
@endsection

{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Effectuez une requête AJAX pour votre endpoint Laravel
    $.ajax({
        url: '/',
        method: 'GET',
        success: function(response) {
            if (response.show_popup) {
                $("#myModal").modal();
            }
        },
        error: function() {
            // Gérer les erreurs si nécessaire
        }
    });
</script> --}}
