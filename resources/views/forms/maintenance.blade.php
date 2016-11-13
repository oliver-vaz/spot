@extends('forms.layout')

@section( 'page_content' )
<!-- Main content -->
<section class="content">
  <!-- Info boxes -->
  <div class="row">
    <div class="block">
        <a class="btn btn-app" data-toggle="modal" data-target="#modal-task" >
          <i class="fa fa-save"></i>
          <b>Nueva Tarea</b>
        </a>

    </div>
  </div><!-- /.content-wrapper -->
  <div class="row">  
    <div class="col-md-4">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Tareas</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <table id="table-tasks" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Nombre</th>
                <th>Kilometraje</th>
              </tr>
            </thead>
            <tbody id="tbody-tasks" name="table-body" >
            </tbody>
          </table>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!-- /.col -->


    <div class="col-md-8">
      <div class="box">
        <div class="box-header">
          <h2 class="box-title">Mantenimientos</h2>
        </div><!-- /.box-header -->
        <div class="box-body">

        <p>Por favor ingrese los datos</p>
        <form action="javascript:void(0);" >
          <div class="box-body">
          <div class="form-group">
            <label for="m-name">Hecho Por</label>
            <input id="m-name" class="form-control" type="text" placeholder="">
          </div>
          <div class="form-group">
            <label for="m-comments">Comentarios</label>
            <textarea id="m-comments" class="form-control" rows="5" type="text" placeholder=""></textarea>
            <input id="_token" type="hidden" value="{{ csrf_token() }}">
          </div>
          <div class="form-group">
            <label>Carro</label>
              <select id="m-car_id" class="form-control"></select>
          </div>

          <div class="form-group">
            <label>Tipo de mantenimiento</label>
              <select id="m-task_id" class="form-control"></select>
          </div>
         </div>
        <div class="box-footer">
          <button id="send-maintenance" class="btn btn-primary" type="submit">Guardar</button>
        </div>
      </form>

        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!-- /.col -->

  </div><!-- /.row -->
</section>
@stop

@section('js')
  <script src="{{ URL::to( 'dist/js/pages/input_handler.js') }}" type="text/javascript"></script>
  <script src="{{ URL::to( 'dist/js/pages/maintenances.js') }}" type="text/javascript"></script>
@stop

@section('modals')

<!-- Modal Create -->
<div id="modal-task" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h2 class="modal-title">Nueva Tarea</h2>
      </div>
      <div class="modal-body">
        <p>Por favor ingrese los datos</p>
        <form action="javascript:void(0);" >
          <div class="box-body">

            <div class="form-group">
              <label for="task-name">Nombre</label>
              <input id="task-name" class="form-control" type="text" placeholder="">
            </div>

            <div class="form-group">
              <label for="task-description">Description</label>
              <input id="task-description" class="form-control" type="text" placeholder="">
              <input id="_token" type="hidden" value="{{ csrf_token() }}">
            </div>

            <div class="form-group">
              <label for="task-km">Periodo Kilometraje</label>
              <input id="task-km" class="form-control" type="text" placeholder="">
            </div>
          </div>
        <div class="box-footer">
          <button id="send-task" class="btn btn-primary" type="submit">Guardar</button>
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