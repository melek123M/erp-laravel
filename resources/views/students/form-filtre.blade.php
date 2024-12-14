<div class="card w-100">
    <div class="card-body">
        <div class="row recherche">
            <div class="form-group col-lg-6 col-md-6 col-sm-12">
                {!! Form::text('email', isset($request) ? $request->input('email', '') : null, [
                    'class' => 'form-control',
                    'placeholder' => 'Rechercher',
                    'id' => "search_student"
                ]) !!}
            </div>
            <div class="form-group col-lg-6 col-md-6 col-sm-12">
                
                <select class="custom-select select2-hidden-accessible" name="type_contract_id[]" id="type_contract_id"
                    multiple="" data-placeholder="Choisir un option" data-select2-id="select2-data-type_contract_id"
                    tabindex="-1" aria-hidden="true">

                    @foreach ($contrats as $key => $conntract)
                        <option value="{{ $conntract->id }}"
                            @if ($typeContractId != '' && in_array($conntract->id, $typeContractId)) selected="selected" @endif>
                            {{ $conntract->name }}</option>
                    @endforeach
                </select>
            </div>
            <!-- <div class="form-group col-sm-2">
                {!! Form::text('name', isset($request) ? $request->input('name', '') : null, [
                    'class' => 'form-control',
                    'placeholder' => 'nom',
                ]) !!}
            </div> -->

            <!-- Maj Status Field -->
            <div class="form-group col-lg-6 col-md-6 col-sm-12">
                {!! Form::select(
                    'maj_status_id',
                    $status->pluck('name', 'id')->all(),
                    isset($request) ? $request->input('maj_status_id', '') : null,
                    ['class' => 'form-control custom-select', 'placeholder' => 'Statut'],
                ) !!}
            </div>
            
            <div class="form-group col-lg-6 col-md-6 col-sm-12">
                {!! Form::select(
                    'establishment_id',
                    $establishments->pluck('name', 'id')->all(),
                    isset($request) ? $request->input('establishment_id', '') : null,
                    ['class' => 'form-control custom-select', 'placeholder' => 'Establissement'],
                ) !!}
            </div>

        </div>
        <div class="flex" style="padding: 15px">
            {!! Form::submit('Rechercher', ['class' => 'btn btn-dark st-btn mr-3', 'id' => 'search-link']) !!}
            <a href="{{ route('students.index') }}" id="affiche-tous-link" class="btn btn-outline-dark st-btn" style=" width: 108.41px; ">
                Annuler
            </a>
        </div>
    </div>
</div>

<style>
 .form-group input {
    outline: none;
    border-color: #e2e8f0 !important;
    border-radius: 12px !important;
    height: 40px;
}

.custom-select {
    outline: none;
    border-color: #e2e8f0 !important;
    border-radius: 12px !important;
    color: #8198af !important;
    font-style: italic;
}
.select2-results li {
    color: #8198af !important;
    font-style: italic;
}
.select2-results li:hover,  .select2-results li:focus{
    color: #fff !important;
    font-style: italic;
}
.select2-container--default .select2-results__option--highlighted[aria-selected], .select2-container--default .select2-results__option--highlighted[aria-selected]:hover {
    background-color: #0074f0;
    color: #fff !important;
}.select2-container--default .select2-selection--multiple .select2-selection__choice__display {
  
    color: #10213b;
}
    .recherche {
        align-items: center;
        justify-content: space-between;
        justify-items: center;
    }

    .select2-container--default .select2-selection--multiple {
        background-color: white;
        /* border: 1px solid #aaa; */
        border-radius: 4px;
        cursor: text;
        padding-bottom: 5px;
        padding-right: 5px;
        position: relative;
        display: none;
        outline: none;
        border-color: #e2e8f0 !important;
        border-radius: 12px !important;
        height: 40px;
    }

    .select2-container--default .select2-dropdown .select2-search__field:focus,
    .select2-container--default .select2-search--inline .select2-search__field:focus {
        outline: none;
        border: none;
    }
    .form-control::placeholder {
        color: #8198af;
        font-size: 14px;
        font-style: italic;
        }
        span.select2-selection.select2-selection--multiple {
    background: #fff url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 4 5'%3E%3Cpath fill='%23343a40' d='M2 0L0 2h4zm0 5L0 3h4z'/%3E%3C/svg%3E") right .75rem center/8px 10px no-repeat;
}
textarea.select2-search__field::placeholder {
    color: #8198af;
    font-size: 14px;
    font-style: italic;
}
</style>
<script>
    $(document).ready(function() {
        $('#type_contract_id').select2({
            allowClear: true,
            placeholder: {
                id: '',
                text: 'contrats',
                selected: false,
                disabled: true
            },
        });
    });
    
</script>
