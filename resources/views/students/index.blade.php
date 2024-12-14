@extends('layouts.app')

@section('content')
    {!! Form::open(['route' => ['students.index'], 'id' => 'form-filter', 'method' => 'GET']) !!}
    <div class="reservation-box text-center">
        @include('students.form-filtre')
    </div>
    {!! Form::close() !!}
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Liste des étudiants</h1>
                </div>
                <div class="col-sm-6 d-flex justify-content-end flex-wrap gap-2">
                    <a class="btn btn-warning  py-2 my-1 st-btn" href="{{ route('students.create') }}">
                        Ajouter
                    </a>
                    <a class="btn btn-warning py-2 my-1 st-btn" href="{{ route('dashboards', ['type' => 'students']) }}">
                        Statistique
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            @include('students.table')
        </div>
    </div>
@endsection
<style>
    select {
      width: 200px;
      padding: 5px;
      font-size: 16px;
      background-color: rgb(40, 157, 196);
    }
  
  </style>
  
<script>
    document.addEventListener('DOMContentLoaded', () => {
      const selectElement = document.getElementById('mySelect');
      const options = selectElement.querySelectorAll('option');
  
      options.forEach(option => {
        option.addEventListener('mouseover', () => {
          option.classList.add('custom-option');
        });
  
        option.addEventListener('mouseout', () => {
          option.classList.remove('custom-option');
        });
      });
    });
  </script>
  