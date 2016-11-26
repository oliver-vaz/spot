@extends('forms.layout')

@section( 'page_content' )
<section class="content">
	<div class="row">
		<div class="col-md-4">
			<div class="box box-default">
				<div class="box-header with-border">
	 				<i class="fa fa-bullhorn"></i>
	 				<h3 class="box-title">Alertas Activas</h3>
				</div>
				<div class="box-body">
				 	<input id="token" type="hidden" value="{{ csrf_token() }}" >
				 	@if( count( $alarms ) > 0  )
					 	@foreach( $alarms as $key => $alarm )
						<div class="callout callout-danger">
							<button class="close" type="button" data-dismiss="alert" data-id="{{ $alarm->id }}"aria-hidden="true">×</button>
							<h2>
								<i class="icon fa fa-ban"></i>Carro: {{ $alarm['car']->marca .'-'.$alarm['car']->modelo .', Placas: '. $alarm['car']->placas }}
							</h2>
							<h5><i>Tarea</i> {{ $alarm->title }} </h5>
							<h5><i>Descripción</i> {{ $alarm->content }}</h5>
						</div>
						@endforeach
					@else
					<div class="callout callout-info">
						<button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button>
						<h2><i class="icon fa fa-check"></i>Ok ;)</h2>
						No hay Alarmas activas.
					</div>
					@endif
				</div>
			</div>
		</div>

		<div class="col-md-8">
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
							<li><a href="#">Action</a></li>
							<li><a href="#">Another action</a></li>
							<li><a href="#">Something else here</a></li>
							<li class="divider"></li>
							<li><a href="#">Separated link</a></li>
						</ul>
					</div>
					<button class="btn btn-box-tool" data-widget="remove">
				</div>
			</div>
			<div class="box-body">
				<div class="row">
					<div class="col-md-12">
						<p class="text-center"><strong>Viajes en esta semana</strong></p>
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
  <script type="application/javascript" src="{{ URL::to( 'dist/js/pages/dashboard.js') }}" type="text/javascript"></script>
<!--  
	<script src="{{ URL::to( 'plugins/chartjs/Chart.min.js' ) }}" type="application/javascript"></script>
-->
@stop
