var CustomerApp = function(){
	return{

		init: function(){
			$('#send-button').unbind( 'click' ).click( function(){
				CustomerApp.buttonSendCustomerApp();
			});

			$('#send-edit-customer').unbind( 'click' ).click( function(){
				CustomerApp.sendUpdateCustomer();
			});

			$( '#send-tariff' ).unbind( 'click' ).click( function(){
				CustomerApp.buttonSendTariff();
			});

			$( '#send-location' ).unbind( 'click' ).click( function(){
				CustomerApp.buttonSendLocation();
			});
			CustomerApp.loadCustomerApp();
		},

		loadCustomerApp: function(){
			var tbody    = $('#table-body');
			var location = $('#location-selector');
			var tariff   = $('#tariff-selector');
			CustomerApp.deleteNodes( tbody, location, tariff );

			$.ajax({
				url: main_path + '/customers', 
				data: {},
				type: 'GET',
				dataType: 'json',
				success: function( _response ){
					var _str_table 	 = '';
					var _str_options = '';
					$.each( _response['customers'], function( i, item ){
						_str_table += '<tr><td>'+item[ 'rfc' ]+'</td><td>'+item['short_name']+ '<td>'+item[ 'address' ]+'</td>';
						_str_table += '</td><td><a data-id="' +item[ 'id' ]+ '"class="btn btn-default btn-danger bdelete">Desactivar</a>&nbsp;';
						_str_table += '<a data-id="' +item[ 'id' ]+ '"class="btn btn-default btn-success bviewedit">Ver/Editar</a>&nbsp;' ;
						_str_table += '<a data-id="' +item[ 'id' ]+ '"class="btn btn-default btn-primary blist">Lista de sucursales</a>&nbsp;';
						_str_table += '<a data-id="' +item[ 'id' ]+ '"class="btn btn-default btn-default btariffs">Lista de tarifas</a></td></tr>';

						_str_options += '<option value="'+ item['id'] +'">'+item['short_name']+'</option>';
					});

					tbody.append( _str_table );
					location.append(_str_options ); 
					tariff.append( _str_options );
					CustomerApp.assignDynamicEvents();
				}
			});
		},

		deleteNodes: function( tbody, location, tariff ){
			tbody.empty();
			location.empty();
			tariff.empty();
		},

		del: function( id_ ){
			if( confirm('¿Desea deshabilitar el cliente?'))
			{
				var _data = { _token: $('#_token').val() };
				$.ajax({
					url: main_path +'/customers/'+ id_,
					data: _data ,
					type: 'DELETE',
					success: function( _response ){
						CustomerApp.loadCustomerApp();
					}, fail: function( _response ){
						alert('Error: hubo un error al solicitar la peticion');
					}
				});
				return true;
			}
			return false;
		},

		assignDynamicEvents: function(){
			$('.bdelete').each( function( i ){
				$(this).unbind( 'click' ).click( function(){
					var id = $(this).data( 'id' );
					CustomerApp.del( id );
				});
			});
			$('.blist').each( function( i ){
				$(this).unbind( 'click' ).click( function(){
					var id = $(this).data( 'id' );
					CustomerApp.getAndDisplayList( id );
				});
			});
			$('.bviewedit').each( function(i){
				$(this).unbind('click').click( function(){
					CustomerApp.showModalEdit( $(this).data('id') );
				});
			});
			$('.btariffs').each( function(i){
				$(this).unbind('click').click( function(){
					CustomerApp.showModalTariffs( $(this).data('id') );
				});
			});
		},
		showModalEdit: function( id ){
			$.ajax({
				url: main_path +'/customers/'+ id ,
				data: {},
				type: 'GET',
				success: function( _response ){
					if( _response['status'] == false ){
						alert( _response['message'] );
						return false;
					}
					var modal_edit = $('#edit-customer');
					CustomerApp.populateCustomerAttr( _response['data'], modal_edit );
					modal_edit.modal('show');
				}, fail: function( _response ){
					alert( 'Error: hubo un error al consultar el servidor' );
				}
			});
		},
		populateCustomerAttr: function( data, modal_edit ){
			$('#name', modal_edit).val( data.name );
			$('#id', modal_edit).val( data.id );
			$('#shortname', modal_edit).val( data.short_name );
			$('#rfc', modal_edit).val( data.rfc );
			$('#phone', modal_edit).val( data.phone );
			$('#cellphone', modal_edit).val( data.cellphone );
			$('#alterphone', modal_edit).val( data.alter_phone );
			$('#address', modal_edit).val( data.address );
			$('#zipcode', modal_edit).val( data.zipcode );
			$('#city', modal_edit).val( data.zipcode );
		},
		showModalTariffs: function(id){
			$.ajax({
				url: main_path +'/customers/'+ id + '/tariffs' ,
				data: {},
				type: 'GET',
				success: function( _response ){
					if( _response['status'] == false ){
						alert( message );
						return false;
					}
					CustomerApp.populateTariffs( _response['data'] );
					$('#modal-list-tariffs').modal('show');
				}, fail: function( _response ){
					alert( 'Error: hubo un error al consultar el servidor' );
				}
			});
		},
		populateTariffs: function( data ){
			var table_content = '';
			$.each( data, function( i, elem ){
				table_content += '<tr><td>' + ( elem.active == 1 ? 'Activo': 'Inactivo' )+ '</td>';
				table_content += '<td>' +elem.customername+ '</td><td>' + elem.price_per_car+ '</td><td>' +elem.price_per_person+ '</td><td>' + elem.init_date + '</td></tr>';
			});
			$('#list-tariffs').empty().append( table_content );
		},
		getAndDisplayList: function( id ){
			$.ajax({
				url: main_path + '/customers/' + id+ '/locations', type:'GET',
				success: function(_response){
					if( _response['status']==false){
						alert( _response['message'] );
						return false;
					}
					CustomerApp.populateListLocations( _response['data'] );
					$('#modal-list-locations').modal('show');
				}
			});
		},
		populateListLocations: function(locations){
			var html = '';
			$.each( locations, function(i,e){
				html += '<tr><td>'+e.name+'</td><td>' +e.description+ '</td></tr>';
			});
			$('#list-locations').empty().append( html );
		},
		buttonSendCustomerApp: function(){
			var data = InputHandler.collectInfo( [ 'name', 'shortname', 'rfc', 'phone', 'cellphone', 'alterphone','address', 'zipcode', 'city', '_token' ], [],  [] );
			$.ajax({ url: main_path + '/customers', 
					data: data, type: 'post', processData: false, contentType: false,
					success: function( _response ){
						if( _response['status'] == true ){
							alert( 'Dato almacenado' );
							_tbody = $('#table-body');
							_tbody.empty();
							CustomerApp.loadCustomerApp();
							$( '#myModal' ).modal( 'hide' );
							InputHandler.eraseInfo( [ 'name', 'shortname', 'rfc', 'phone', 'cellphone', 'alterphone', 'address', 'zipcode' , 'city' ], []);
						} else {
							alert(_response['message']);
						}
					},
					fail: function( _response ){
						alert('Error: hubo un error al solicitar la peticion');
					}
			});
		},

		buttonSendTariff: function(){
			var data = InputHandler.collectInfo( 
				[ 'car-price', 'person-price', 'init-date', 'tarrif-checkbox', '_token' ], 
				[ 'tariff-selector' ], [] );
			$.ajax({ 
					url: main_path + '/customers/tariff',
					data:data,
					type:'post',
					processData:false, contentType:false,
					success: function( _response ){
						if( _response['status'] == true ){
							console.log( _response );
							$( '#modal-tariffs' ).modal( 'hide' );
						} else {
							alert( _response['message'] );
						}
					}, 
					fail: function( _response ){
						alert('Error: hubo un error al solicitar la peticion');
					}
			});
		},

		buttonSendLocation: function(){
			var data = InputHandler.collectInfo( 
				[ 'location-name', 'location-address', '_token' ], 
				[ 'location-selector' ], []);

			$.ajax({ 
				url: main_path + '/customers/location', 
				data: data,
				type: 'POST',
				processData:false,contentType: false,
				success: function( _response ){
					if( _response['status'] == true ){
						console.log( _response );
						$( '#modal-locations' ).modal( 'hide' );
						InputHandler.eraseInfo( [ 'location-name', 'location-address', '_token' ], [ 'location-selector' ]);

					} else {
						alert( _response['message'] );
					}
				}, fail: function( _response ){
						alert('Error: hubo un error al solicitar la peticion');
				}
			});
		},

		sendUpdateCustomer : function(){
			var modal_edit = $('#edit-customer');
			var data = CustomerApp.getDataForUpdate( modal_edit );

			$.ajax({ 
				url: main_path + '/customers/' + $('#id', modal_edit).val(), data: data, type: 'PUT',
				success: function( _response ){
					console.log( _response );
					if( _response['status'] == true ){
						console.log( _response );
						CustomerApp.loadCustomerApp();
						$( '#modal-locations' ).modal( 'hide' );
						InputHandler.eraseInfoInContext( [ 'name', 'shortname', 'rfc', 'phone', 'cellphone', 'alterphone','address', 'zipcode', 'city' ], []);
						modal_edit.modal('hide');
					} else {
						alert( _response['message'] );
					}
				}, fail: function( _response ){
						alert('Error: hubo un error al solicitar la peticion');
				}
			});
		},
		getDataForUpdate: function(context){
			return {
				name: $('#name', context ).val(),
				shortname: $('#shortname', context ).val(),
				rfc: $('#rfc', context).val(),
				phone: $('#phone', context).val(),
				cellphone: $('#cellphone', context ).val(),
				alterphone: $('#alterphone',context).val(),
				address: $('#address', context).val(),
				zipcode: $('#zipcode',context).val(),
				city: $('#city',context).val(),
				_token: $('#_token',context).val()
			};
		}
	}//RETURN END!!!
}();
$(function(){	CustomerApp.init();	});