@extends('layouts.dashboard-navbar')

@section('scripts')

  <!-- Jquery -->  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <!-- Bootstrap CSS --  SI SE QUITA ESTE ENLACE, EL BOTÓN PRIMARY TOMA FONDO VERDE-->
  <link href='https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.css' rel='stylesheet' />
  <!-- Font Awesome CSS -->
  <link href='https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.13.1/css/all.css' rel='stylesheet'>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
    integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
    integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
    crossorigin="anonymous"></script>

@endsection

  <!-- Custom  Style -->
  <style>
    html,
    body {
      margin: 0;
      padding: 0;
    }
    .mybtn {
        height: 2.4rem !important;
        width: auto !important;
        font-size: 1.4rem !important;
    }
  </style>

@section('content')

    <div class="card col-12">
        <div class="card-header">
            <div class="float-left"><h2>Gestió d'usuaris <small>({{ count($users)}})</small></h2></div>
            <div class="float-left" class="sr-only" style="padding: 10px 10px;"> {{ $users->links() }}</div>
            {{-- @can('create') --}}
            <button type="button" class="btn btn-primary float-right" style="margin-top: .5rem;" data-toggle="modal" data-target="#create-user"> Afegir un usuari</button>
            {{-- @endcan --}}
        </div>
    <!-- Contenido que se desee -->
    <table class="table table-striped">
      <thead class="thead">
          <tr>
            <td class="col-md-1"><h5>ID</h5></td>
            <td class="col-md-2"><h5>Nom</h5></td>
            <td class="col-md-2"><h5>Cognom</h5></td>
            <td class="col-md-2"><h5>E-mail</h5></td>
            <td class="col-md-1"><h5>Rol</h5></td>
            <td class="col-md-4"><h5>Accions</h5></td>
        </tr>
    </thead>

    @foreach($users as $user)
    @can('view-any', $user)
    <tr>
        <td class="col-md-1">{{$user->id}}</td>
        <td class="col-md-2">{{$user->first_name}}</td>
        <td class="col-md-2">{{$user->last_name}}</td>
        <td class="col-md-2">{{$user->email}}</td>
        <td class="col-md-1">{{$user->role_id}}</td>        
        <td class="col-md-4">
            <a href="mailto:{{$user->email}}?subject=Assumpte...&body=Hola, {{$user->first_name}}!" target="_blank" 
              style='font-size:2rem' class="mybtn btn btn-dark btn-lg">  <i class=' fas fa-envelope'></i>
            </a>
        </td>
        <td>
              @can('update', $user)
              <a style="color:white" data-toggle="modal" data-target="#edit-user{{$user->id}}" class="btn btn-info" user="button">Editar</a>
              @include('user.edit')
              @endcan
          </td>
          <td>
              <a style="color:white" data-toggle="modal" data-target="#show-user{{$user->id}}" class="btn btn-info" user="button">Detalls</a>
              @include('user.show')
          </td>
          <td>      
              @can('destroy', $user)
              <a style="color:white" data-toggle="modal" data-target="#destroy-user{{$user->id}}" class="btn btn-danger" user="button">Esborrar</a>
              @include('user.destroy')
              @endcan
          </td>
      </tr>
      @endcan
      @endforeach

  </table>
  </div>

@endsection
@include('user.create')
@include('user.edit')
@include('user.show')
@include('user.destroy')