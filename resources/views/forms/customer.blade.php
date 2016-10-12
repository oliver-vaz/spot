@extends('forms.layout')

@section( 'page_content' )
<!-- Main content -->
<section class="content">
  <!-- Info boxes -->
  <div class="row">
    <div class="block">
        <a class="btn btn-app" data-toggle="modal" data-target="#myModal" >
          <i class="fa fa-save"></i>
          <b>Nuevo Cliente</b>
        </a>
        <a class="btn btn-app" data-toggle="modal" data-target="#modal-tariffs" >
          <i class="fa fa-inbox"></i>Tarifas
        </a>
        <a class="btn btn-app" data-toggle="modal" data-target="#modal-locations" >
          <span class="badge bg-teal"></span>
          <i class="fa fa-inbox"></i>Locaciones
        </a>
    </div>
  </div><!-- /.content-wrapper -->
  <div class="row">  
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Clientes Disponibles</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <table id="table-drivers" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>RFC</th>
                <th>Nombre</th>
                <th>Direccion</th>
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
  <script src="{{ URL::to( 'dist/js/pages/validator.js') }}" type="text/javascript"></script>
  <script src="{{ URL::to( 'dist/js/pages/input_handler.js') }}" type="text/javascript"></script>
  <script src="{{ URL::to( 'dist/js/pages/customers.js') }}" type="text/javascript"></script>
  <script src="{{ URL::to( 'plugins/input-mask/jquery.inputmask.js' ) }}" type="text/javascript"></script>
  <script src="{{ URL::to( 'plugins/input-mask/jquery.inputmask.extensions.js' ) }}" type="text/javascript"></script>
  <script src="{{ URL::to( 'plugins/input-mask/jquery.inputmask.date.extensions.js') }}" type="text/javascript"></script>
@stop

@section('modals')

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal Add Customer-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Nuevo Cliente</h4>
      </div>
      <div class="modal-body">
        <p>Por favor ingrese los datos</p>
        <form action="javascript:void(0);" >
          <div class="box-body">
          <div class="form-group">
            <label for="name">Nombre</label>
            <input id="name" class="form-control" type="text" placeholder="">
          </div>
          <div class="form-group">
            <label for="shortname">Nombre Corto</label>
            <input id="shortname" class="form-control" type="text" placeholder="">
            <input id="_token" type="hidden" value="{{ csrf_token() }}">
          </div>
          <div class="form-group">
            <label for="rfc">RFC</label>
            <input id="rfc" class="form-control" type="text" placeholder="">
          </div>

          <div class="form-group">
            <label for="phone">Telefono</label>
            <input id="phone" class="form-control" type="text" placeholder="">
          </div>
          <div class="form-group">
            <label for="cellphone">Celular de contacto</label>
            <input id="cellphone" class="form-control" type="text" placeholder="">
          </div>
          <div class="form-group">
            <label for="alterphone">Telefono Alterno</label>
            <input id="alterphone" class="form-control" type="text" placeholder="">
          </div>

          <div class="form-group">
            <label for="address">Direccion</label>
            <input id="address" class="form-control" type="text" placeholder="">
          </div>
          <div class="form-group">
            <label for="zipcode">Codigo Postal</label>
            <input id="zipcode" class="form-control" type="text" placeholder="">
          </div>
          <div class="form-group">
            <label for="city">Ciudad</label>
            <input id="city" class="form-control" type="text" placeholder="">
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


<!-- Modal Add Location -->
<div id="modal-locations" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Agregar Locacion</h4>
      </div>
      <div class="modal-body">
        <p>Por favor ingrese los datos</p>
        <form action="javascript:void(0);" >
          <div class="box-body">
          <div class="form-group">
            <label>Cliente</label>
              <select id="location-selector" class="form-control">
              </select>
          </div>
          <div class="form-group">
            <label for="location-name">Nombre (Normalmente es la calle)</label>
            <input id="location-name" class="form-control" type="text" placeholder="">
          </div>

          <div class="form-group">
            <label for="location-address">Direccion</label>
            <textarea id="location-address" class="form-control" rows="3" placeholder=""></textarea>
          </div>

         </div>
        <div class="box-footer">
          <button id="send-location" class="btn btn-primary" type="submit">Guardar</button>
        </div>
      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div id="modal-tariffs" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h2 class="modal-title">Agregar <strong>Tarifa</strong></h2>
      </div>
      <div class="modal-body">
        <p>Por favor ingrese los datos</p>
        <form action="javascript:void(0);" >
          <div class="box-body">

          <div class="form-group">
            <label>Cliente:</label>
              <select id="tariff-selector" class="form-control">
              </select>
          </div>

          <div class="form-group">
            <label for="car-price">Precio por Carro:</label>
            <input id="car-price" class="form-control" type="text" placeholder="0">
          </div>

          <div class="form-group">
            <label for="person-price">Precio por Persona:</label>
            <input id="person-price" class="form-control" type="text" placeholder="0">
          </div>

          <div class="form-group">
            <label>Fecha de inicio de la tarifa:</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <input id="init-date" class="form-control" type="text" data-mask="" data-inputmask="'alias': 'dd/mm/yyyy'" placeholder="dd/mm/yyyy">
            </div>
          </div>

          <div class="checkbox">
            <label>
              <input id="tarrif-checkbox" type="checkbox" checked >¿Es la Tarifa Actual?
            </label>
          </div>
         </div>
        <div class="box-footer">
          <button id="send-tariff" class="btn btn-primary" type="submit">Guardar</button>
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