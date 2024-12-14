<!-- Civility Field -->
<div class="col-sm-6">
    {!! Form::label('civility', 'Civility:') !!}
    @if (isset($student->civilitie))
        <p>{{ $student->civilitie->name }}</p>
    @endif
</div>

<!-- Name Field -->
<div class="col-sm-6">
    {!! Form::label('name', 'Nom:') !!}
    <p>{{ $student->name }}</p>
</div>

<!-- Last Name Field -->
<div class="col-sm-6">
    {!! Form::label('last_name', 'prénom:') !!}
    <p>{{ $student->last_name }}</p>
</div>

<!-- Email Field -->
<div class="col-sm-6">
    {!! Form::label('Email', 'Email:') !!}
    <p>{{ $student->email }}</p>
</div>

<!-- Phone Field -->
<div class="col-sm-6">
    {!! Form::label('phone', 'N° de téléphone:') !!}
    <p>{{ $student->phone }}</p>
</div>

<!-- Num Security Social Field -->
<div class="col-sm-6">
    {!! Form::label('num_security_social', 'Num Security Social:') !!}
    <p>{{ $student->num_security_social }}</p>
</div>

<!-- Adress Field -->
<div class="col-sm-6">
    {!! Form::label('adress', 'Adress:') !!}
    <p>{{ $student->adress }}</p>
</div>

<!-- City Field -->
<div class="col-sm-6">
    {!! Form::label('city', 'Ville:') !!}
    <p>{{ $student->city }}</p>
</div>

<!-- Zip Code Field -->
<div class="col-sm-6">
    {!! Form::label('zip_code', 'Code Postal:') !!}
    <p>{{ $student->zip_code }}</p>
</div>

<!-- Maj Status Field -->
<div class="col-sm-6">
    {!! Form::label('maj_status', 'Statut:') !!}
    @if (isset($student->statu))
        <p>{{ $student->statu->name }}</p>
    @endif
</div>

<!-- Type Contract Field -->
<div class="col-sm-6">
    {!! Form::label('type_contract', 'Type Contract:') !!}
    @if (isset($student->contracts))
        @foreach ($student->contracts as $i => $contract)
            <p style="padding-left: 2%;">{{ $i + 1 }}){{ $contract->name }}</p>
        @endforeach
    @endif
</div>
