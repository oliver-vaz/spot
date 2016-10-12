@extends('forms.layout')

@section( 'page_content' )
<!-- Main content -->
<section class="content">
  <!-- Info boxes -->
  <div class="row">
    <div class="block">
        <a class="btn btn-app" data-toggle="modal" data-target="#myModal" >
          <i class="fa fa-save"></i>
          <b>Nuevo Carro</b>
        </a>
        <a class="btn btn-app">
<i class="fa fa-play"></i>
Play
</a>
    </div>
  </div><!-- /.content-wrapper -->
  <div class="row">  
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Carros Disponibles</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <table id="table-cars" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Placas</th>
                <th>Año</th>
                <th>Opciones</th>
              </tr>
            </thead>
            <tbody id="table-body" name="table-body" >
            </tbody>
          </table>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!-- /.col -->
  </div><!-- /.row -->
</section>
@stop

@section('js')
  <script src="{{ URL::to( 'dist/js/pages/cars.js') }}" type="text/javascript"></script>
  <script src="{{ URL::to( 'dist/js/pages/input_handler.js') }}" type="text/javascript"></script>
@stop

@section('modals')

<!-- Modal Create -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Nuevo Carro</h4>
      </div>
      <div class="modal-body">
        <p>Por favor ingrese los datos</p>
        <form action="javascript:void(0);" >
          <div class="box-body">

            <div class="form-group">
              <label for="brand">Marca</label>
              <input id="brand" class="form-control" type="text" placeholder="">
            </div>

            <div class="form-group">
              <label for="model">Modelo</label>
              <input id="model" class="form-control" type="text" placeholder="">
              <input id="_token" type="hidden" value="{{ csrf_token() }}">
            </div>

            <div class="form-group">
              <label for="placas">Placas</label>
              <input id="placas" class="form-control" type="text" placeholder="">
            </div>

            <div class="form-group">
              <label>Año</label>
                <select id="year-selector" class="form-control">
                  <option value="2010">2010</option>
                  <option value="2011">2011</option>
                  <option value="2012">2012</option>
                  <option value="2013">2013</option>
                  <option value="2014">2014</option>
                  <option value="2015">2015</option>
                  <option value="2016">2016</option>
                  <option value="2017">2017</option>
                  <option value="2018">2018</option>
                </select>
            </div>

            <div class="form-group">
              <label>Conductor asignado</label>
                <select id="driver-selector" class="form-control">
                </select>
            </div>

          </div>
        <div class="box-footer">
          <button id="send-button" class="btn btn-primary" type="submit">Guardar</button>
        </div>
      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>



<!-- Modal Update -->
<div id="modal-update" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h2 class="modal-title">Actualizar Datos de Carro</h2>
      </div>
      <div class="modal-body">
        <p>Por favor ingrese los datos</p>
        <form action="javascript:void(0);" >
          <div class="box-body">

            <div class="form-group">
              <label for="u-brand">Marca</label>
              <input id="u-brand" class="form-control" type="text" placeholder="">
              <input id="u-id" type="hidden" class="form-control" type="text" >
            </div>

            <div class="form-group">
              <label for="u-model">Modelo</label>
              <input id="u-model" class="form-control" type="text" placeholder="">

            </div>

            <div class="form-group">
              <label for="u-placas">Placas</label>
              <input id="u-placas" class="form-control" type="text" placeholder="">
            </div>

            <div class="form-group">
              <label for="u-km">Kilometraje</label>
              <input id="u-km" class="form-control" type="text" placeholder="">
            </div>

            <div class="form-group">
              <label>Año</label>
                <select id="u-year" class="form-control">
                  <option value="2010">2010</option>
                  <option value="2011">2011</option>
                  <option value="2012">2012</option>
                  <option value="2013">2013</option>
                  <option value="2014">2014</option>
                  <option value="2015">2015</option>
                  <option value="2016">2016</option>
                  <option value="2017">2017</option>
                  <option value="2018">2018</option>
                </select>
            </div>

            <div class="form-group">
              <label>Conductor asignado</label>
                <select id="u-driver-selector" class="form-control">
                </select>
            </div>

          </div>
        <div class="box-footer">
          <button id="send-update" class="btn btn-primary" type="submit">Guardar</button>
        </div>
      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<!-- Modal New Alarm -->
<div id="modal-alarm" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h2 class="modal-title">Crear un Alarma para el carro</h2>
      </div>
      <div class="modal-body">
        <p>Por favor ingrese los datos</p>
        <form action="javascript:void(0);" >
          <div class="box-body">

            <div class="form-group">
              <label for="u-brand">Título</label>
              <input id="a-title" class="form-control" type="text" placeholder="">
              <input id="a-id-car" type="hidden" class="form-control" type="text" >
            </div>

            <div class="form-group">
              <label for="a-content">Descripción</label>
              <input id="a-content" class="form-control" type="text" placeholder="">

            </div>

            <div class="form-group">
              <label>Tarea Asociada o Pendiente (si aplica)</label>
                <select id="a-id-task" class="form-control">
                </select>
            </div>
          </div>
        <div class="box-footer">
          <button id="send-alarm" class="btn btn-primary" type="submit">Guardar</button>
        </div>
      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


@stop