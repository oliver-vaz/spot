@extends('forms.layout')

@section( 'page_content' )
<section class="content">
<div class="row">
<div class="col-md-6 col-sm-6 col-xs-12">
<div class="info-box">
<span class="info-box-icon bg-aqua">
<i class="ion ion-ios-gear-outline"></i>
</span>
<div class="info-box-content">
<span class="info-box-text">
<b>Viajes</b>
Registrados Hoy
</span>
<span class="info-box-number">
<big>
<b>:)</b>
</big>
</span>
</div>
</div>
</div>
<div class="col-md-6 col-sm-6 col-xs-12">
<div class="info-box">
<span class="info-box-icon bg-red">
<i class="fa fa-google-plus"></i>
</span>
<div class="info-box-content">
<span class="info-box-text">
<b>Numero de Viajes</b>
Semanales
</span>
<span class="info-box-number">
<big>
<b>:S</b>
</big>
</span>
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-md-12">
<div class="box">
<div class="box-header with-border">
<h3 class="box-title">Viajes por semana</h3>
<div class="box-tools pull-right">
<button class="btn btn-box-tool" data-widget="collapse">
<i class="fa fa-minus"></i>
</button>
<div class="btn-group">
<button class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
<i class="fa fa-wrench"></i>
</button>
<ul class="dropdown-menu" role="menu">
<li>
<a href="#">Action</a>
</li>
<li>
<a href="#">Another action</a>
</li>
<li>
<a href="#">Something else here</a>
</li>
<li class="divider"></li>
<li>
<a href="#">Separated link</a>
</li>
</ul>
</div>
<button class="btn btn-box-tool" data-widget="remove">
</div>
</div>
<div class="box-body">
<div class="row">
<div class="col-md-12">
<p class="text-center">
<strong>Viajes en esta semana</strong>
</p>
<div class="chart">
<canvas id="salesChart" height="180" style="width: 925px; height: 180px;" width="925"></canvas>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</section>
@endsection


@section('js')
  <script src="{{ URL::to( 'dist/js/pages/main_dashboard.js') }}" type="text/javascript"></script>
  <script src="{{ URL::to( 'plugins/chartjs/Chart.min.js' ) }}" type="text/javascript"></script>
@stop
