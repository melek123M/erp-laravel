 <!-- Name Field -->
 <input type="hidden" name="lat" id="lat">
 <input type="hidden" name="lon" id="lon">
 <div class="form-group col-sm-6">
     {!! Form::label('name', 'Nom:') !!}
     {!! Form::text('name', isset($request) ? $request->name : null, ['class' => 'form-control', 'required']) !!}
 </div>

 <!-- Last Name Field -->
 <div class="form-group col-sm-6">
     {!! Form::label('last_name', 'prénom:') !!}
     {!! Form::text('last_name', isset($request) ? $request->last_name : null, ['class' => 'form-control']) !!}
 </div>
 <!-- date_naissance -->
 <div class="form-group col-sm-6">
     {!! Form::label('date_naissance', 'Date de naissance:') !!}
     {!! Form::date('date_naissance', isset($request) ? $request->date_naissance : null, ['class' => 'form-control']) !!}
 </div>
 <!-- Email Field -->
 <div class="form-group col-sm-6">
     {!! Form::label('email', 'Email:') !!}
     {!! Form::email('email', isset($request) ? $request->email : null, [
         'class' => 'form-control',
         'required' => 'required',
     ]) !!}
 </div>

 <!-- Phone Field -->
 <div class="form-group col-sm-6">
     {!! Form::label('phone', 'N° de téléphone:') !!}
     {!! Form::text('phone', isset($request) ? $request->phone : null, ['class' => 'form-control', 'required']) !!}
 </div>

 <!-- Num Security Social Field -->
 <div class="form-group col-sm-6">
     {!! Form::label('num_security_social', 'N° de sécurité sociale:') !!}
     {!! Form::text('num_security_social', isset($request) ? $request->num_security_social : null, [
         'class' => 'form-control',
         'required',
     ]) !!}
 </div>

 <!-- Adress Field -->
 <div class="form-group col-sm-6">
     <label for="select-adress">Complément Adress:</label>
     <select id="mySelect" class="form-control" style="width: 200px;" name="adress"></select>

 </div>


 <!-- City Field -->
 <div class="form-group col-sm-6">
     {!! Form::label('city', 'Ville:') !!}
     {!! Form::text('city', isset($request) ? $request->city : null, ['class' => 'form-control']) !!}
 </div>

 <!-- Zip Code Field -->
 <div class="form-group col-sm-6">
     {!! Form::label('zip_code', 'Code postal:') !!}
     {!! Form::text('zip_code', isset($request) ? $request->zip_code : null, ['class' => 'form-control']) !!}
 </div>


 <!-- Maj Status Field -->
 <div class="form-group col-sm-6">
     {!! Form::label('maj_status_id', 'Statut:') !!}
     {!! Form::select(
         'maj_status_id',
         $status->pluck('name', 'id')->all(),
         isset($request) ? $request->maj_status_id : null,
         ['class' => 'form-control custom-select', 'placeholder' => 'Merci de choisir'],
     ) !!}
 </div>

 <!-- Type Contract Field -->

 <div class="form-group col-sm-6">
     <label for="resulta_id">Type de contrat:</label>
     <select class="custom-select" name="type_contract_id[]" id="type_contract_id" multiple="multiple"
         placeholder = "Merci de choisir">
         @foreach ($contrats as $key => $conntract)
             <option value="{{ $conntract->id }}" @if (isset($intersectedConntractIds) && in_array($conntract->id, $intersectedConntractIds)) selected="selected" @endif>
                 {{ $conntract->name }}</option>
         @endforeach
     </select>
 </div>
 <div class="form-group col-sm-6">
     {!! Form::label('establishment_id', 'établissement:') !!}
     {!! Form::select(
         'establishment_id',
         $establishments->pluck('name', 'id')->all(),
         isset($request) ? $request->establishment_id : null,
         ['class' => 'form-control custom-select', 'placeholder' => 'Merci de choisir'],
     ) !!}
 </div>
