@extends('layouts.app-dashboard')

@section('scripts')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link href='https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.css' rel='stylesheet' />
    <link href='https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.13.1/css/all.css' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
        crossorigin="anonymous"></script>

@endsection

@section('content')

    <div class="col">
        @include('custom.message')
        <div class="dashboard-right-side">
            <div class="float-left">
            <h2>Gestió de l'Equip</h2>
            </div>
                @if (auth()->user()->role_id === "Admin")
                    <button type="button" class="cta" data-toggle="modal" data-target="#create-team">Afegir un membre de l'equip</button>
                    @include('team.create')
                @endif
        </div>

        <div class="dashboard-right-side">
            <table class="table table-striped table-borderless">
            <thead class="thead text-uppercase">
                <tr>
                <td><small><b>Imatge</b></small></td>
                <td><small><b>Nom i Cognom</b></small></td>
                <td><small><b>Professió</b></small></td>
                <td colspan="2"><small><b>Accions</b></small></td>
                </tr>
            </thead>
            @foreach($teams as $team)
                @can('view-any', $team)
                    <tr>
                            <td class="dashboard-team member">
                            <img src="{{$team->get_photo_url()}}">
                            </td>
                            <td class="icon-text">
                            <div class="primary-green">
                                <a data-toggle="modal" data-target="#show-team{{$team->id}}" class="primary-green" type="button">
                                <i class="icofont-user-alt-3"></i>
                                {{$team->first_name}}, {{$team->last_name}}
                                </a>
                            </div>
                            @include('team.show')
                            </td>
                            <td>{{$team->position}}</td>
                            <td class="actions">
                                @can('update', $team)
                                    <div class="primary-green">
                                    <a href="" data-toggle="modal" data-target="#edit-team{{$team->id}}" class="primary-green" type="button">
                                        <i class="icofont-ui-edit"></i>
                                    </a>
                                    </div>
                                    @include('team.edit')
                                @endcan
                            </td>
                            <td class="actions danger">
                            @can('destroy', $team)
                                <a href="" data-toggle="modal" data-target="#destroy-team{{$team->id}}" class="danger" type="button">
                                <i class="icofont-ui-delete"></i>
                                </a>
                                @include('team.destroy')
                            @endcan
                        </td>
                    </tr>
                @endcan
            @endforeach
            </table>
        </div>

        <div class="dashboard-right-side d-flex align-items-center justify-content-end">
            <div><small>Mostrant {{ count($teams) }} de {{ $teams->total() }}</small></div>
            <div>{{ $teams->links() }}</div>
        </div>
    </div>

@endsection
