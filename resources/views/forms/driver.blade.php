@extends('forms.layout')

@section( 'page_content' )
<!-- Main content -->
<section class="content">
  <!-- Info boxes -->
  <div class="row">
    <div class="block">
        <a class="btn btn-app" data-toggle="modal" data-target="#myModal" >
          <i class="fa fa-save"></i>
          <b>Nuevo Conductor</b>
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
          <h3 class="box-title">Conductores Disponibles</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <table id="table-drivers" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Acciones</th>
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
  <script src="{{ URL::to( 'dist/js/pages/drivers.js') }}" type="text/javascript"></script>
@stop

@section('modals')

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Nuevo Conductor</h4>
      </div>
      <div class="modal-body">
        <p>Por favor ingrese los datos</p>
        <form action="javascript:void(0);" >
          <div class="box-body">
          <div class="form-group">
            <label for="name">Nombres</label>
            <input id="name" class="form-control" type="text" placeholder="">
          </div>
          <div class="form-group">
            <label for="last-name">Apellidos</label>
            <input id="last-name" class="form-control" type="text" placeholder="">
            <input id="token" type="hidden" value="{{ csrf_token() }}">

            <input id="token2" type="hidden" value="{{ csrf_token() }}">
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

@stop