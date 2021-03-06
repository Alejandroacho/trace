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
    <div class="dashboard-right-side">
        <div class="col">
            <div class="mt-3">
                <div class="float-left">
                    <h2>Benvingut/da {{Auth::User()->first_name}}</h2>
                    <h4 class="bold pt-2">ACTIVITATS D'AVUI</h4>
                </div>
            </div>
        </div>       
    </div>
    <div class="dashboard-right-side">
        @if (count($activities) != 0)
            <table class="table table-striped table-borderless">
                <thead class="thead text-uppercase">
                    <tr>
                        <td><small><b>Títol</b></small></td>
                        <td><small><b>Horari</b></small></td>
                        <td colspan="2"><small><b>Professional</b></small></td>
                    </tr>
                </thead>
        @endif
        @if ($activities)
            @foreach($activities as $activity)
            <tr>
                <td>
                    <div>
                        @isset ($activity->category_id)
                            <i class="fa fa-circle" style="font-size:20px;color:{{$activity->getCategoryColor()}}"></i>
                        @endisset
                        {{$activity->title}}
                    </div>
                </td>
                <td style="font-weight: bold;">{{$activity->start}} {{substr($activity->showStart, 8)}} - {{substr($activity->showEnd, 10)}} </td>

                <td class="icon-text">
                    <div class="primary-green">
                    @foreach ($activity->users as $user)
                    @if ($user->role_id !== 'Soci')
                        <a href="mailto:{{$user->email}}?subject=Assumpte...&body=Hola, {{$user->first_name}}!" target="_blank" class="primary-green">
                        <i class="icofont-send-mail" style="font-size:24px"></i>
                        {{$user->first_name}} {{$user->last_name}}
                        </a>
                    @endif
                    @endforeach
                    </div>
                </td>

                <td>
                    <a href="" data-toggle="modal" data-target="#show-activity{{$activity->id}}" class="cta" activity="button">Veure més</a>
                    @include('activity.show')
                </td>
            </tr>
            @endforeach
        @endif

        </table>
    </div>
    @if (count($activities) == 0)
    <div class="dashboard-right-side">
        <div class="float-left">
            <h4>Avui no tens cap activitat programada.</h4>
            <p>Pots veure les activitats de tota la setmana prement a "La setmana" a l'esquerra.</p>
        </div>
    </div>
    @endif
</div>

@endsection

<!-- Vendor JS Files -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/jquery.easing/jquery.easing.min.js"></script>
<script src="vendor/php-email-form/validate.js"></script>
<script src="vendor/jquery-sticky/jquery.sticky.js"></script>
<script src="vendor/owl.carousel/owl.carousel.min.js"></script>
<script src="vendor/waypoints/jquery.waypoints.min.js"></script>
<script src="vendor/counterup/counterup.min.js"></script>
<script src="vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="vendor/venobox/venobox.min.js"></script>

<!-- Template Main JS File -->
<script src="js/main.js"></script>

<a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

</html>
