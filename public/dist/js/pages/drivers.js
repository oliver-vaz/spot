var Driver = function(){
	return{
		modal_confirm: null,
		table_body: null,
		del_id: null,
		main_modal: null,

		init: function(){

			this.modal_confirm = $('#modal-del');
			this.table_body = $('#table-body');
			this.del_id = $('#del-driver-id');
			this.main_modal = $('#myModal');

			$.ajax({
				url: main_path + '/drivers',
				data: {},
				type: 'GET',
				dataType: 'json',
				success: function( _response ){
					var html = '';
					$.each( _response['drivers'], function( i, item ){
						html += '<tr><td>' +item[ 'name' ]+'</td><td>'+item['lastname']+
								'</td><td>' + item['alias'] + '</td><td>' + item['end_licence'] + '</td><td>' +
								'<a data-id="' +item[ 'id' ]+ '" class="btn btn-warning btn-edit">Editar</a>&nbsp' + 
								( item['active'] == 0 ?
									'<a data-id="' +item[ 'id' ]+ '" class="btn btn-primary">Activar</a>&nbsp' : 
									'<a data-id="' +item[ 'id' ]+ '"class="btn btn-default btn-danger bdelete">Desactivar</a>' ) + '</td></tr>';
					});
					Driver.table_body.append( html );
					Driver.assignEvents();
				}
			});

			$('#del-confirm').unbind('click').click( function(){
				if( Driver.del_id.val() > 0 ){
					Driver.del( Driver.del_id.val() );
				}
			});
		},

		del: function( id_ ){
			$.ajax({
				url: main_path +'/drivers/'+ id_,
				data: { _token : $( '#token' ).val() },
				type: 'DELETE',
				dataType: 'json',
				success: function( _response ){
					Driver.table_body.empty();
					Driver.init();
					Driver.modal_confirm.modal('hide');
				}, fail: function( _response ){
					console.log( _response );
				}
			});
		},
		getDataById: function( id ){
			$.ajax({
				url: main_path + '/drivers/' + id, type: 'GET',
				success: function( _response ){
					if(_response['status'] == false){
						alert('Error: dato no encontrado');
						return false;
					}
					console.log( _response['data'] );
					Driver.populateModal(_response['data']);
				},
				fail: function(_response){
					alert('Error: hubo un error al conseguir la informacion del conductor');
				}
			});
		},
		
		populateModal: function( _data ){
			Driver.main_modal.modal('show');
			$('#name', Driver.main_modal ).val( _data.name );
			$('#type', Driver.main_modal ).val( 'update' );
			$('#last-name', Driver.main_modal ).val( _data.lastname );
			$('#id', Driver.main_modal ).val( _data.id );
			$('#alias', Driver.main_modal ).val( _data.alias );
			$('#address', Driver.main_modal ).val( _data.address );
			$('#phone', Driver.main_modal ).val( _data.phone );
			$('#cellphone', Driver.main_modal ).val( _data.cellphone );
			$('#driver_license',Driver.main_modal ).val( _data.number_licence );
			$('#license_end',Driver.main_modal ).val( _data.end_licence );
		},
		eraseModal: function(){
			$('#name', Driver.main_modal ).val('');
			$('#type', Driver.main_modal ).val( 'new' );
			$('#last-name', Driver.main_modal ).val('');
			$('#id', Driver.main_modal ).val('');
			$('#alias', Driver.main_modal ).val('');
			$('#address', Driver.main_modal ).val('');
			$('#phone', Driver.main_modal ).val('');
			$('#cellphone', Driver.main_modal ).val('');
			$('#driver_license',Driver.main_modal ).val('');
			$('#license_end',Driver.main_modal ).val('');
		},

		assignEvents: function(){
			$('.btn-edit').each( function( i, item ){
				$(item).unbind( 'click' ).click( function(){
						console.log('Fuck event edit' + $(item).data( 'id' ) );
						Driver.getDataById( $(this).data( 'id' ) );
				});
			});
			$('.bdelete').each( function( i ){
				$(this).unbind( 'click' ).click( function(){
					Driver.del_id.val( $(this).data( 'id' ) );
					Driver.modal_confirm.modal('show');
				});
			});
			$('.btn-primary').unbind( 'click' ).click( function(){
				Driver.activate($(this).data( 'id' ));
			});

			$('#send-button').unbind( 'click' ).click( function(){
				var data = Driver.collectData();
				if( data === false )
					return false;
				
				if($('#type', Driver.main_modal).val() == 'update')
					Driver.updateItem(data);
				else
					Driver.saveNew(data);
			});
		},
		activate: function( id ){
			console.log( $('#token').val() );
			if(id>0){
				$.ajax(
					{ url: main_path + '/drivers/'+ id +'/activate', data: { _token: $('#token').val() }, type: 'POST', dataType: 'json',
					success: function( _response ){
						if( _response['status'] == true ){
							Driver.table_body.empty();
							Driver.init();
						} else {
							alert( _response['message'] );
							console.log( _response );
						}
					}, fail: function( _response ){
						alert('Error: hubo un error al realizar la peticion');
						console.log( _response );
					}
				});
			}
		},
		saveNew: function( data ){
			$.ajax(
				{ url: main_path + '/drivers', data: data, type: 'POST', dataType: 'json',
				success: function( _response ){
					if( _response['status'] == true ){
						Driver.table_body.empty();
						Driver.init();
						Driver.main_modal.modal( 'hide' );
						Driver.eraseModal();

					} else {
						console.log( 'Error' );
						console.log( _response );
					}
				}, fail: function( _response ){
					console.log( 'Fail' );
					console.log( _response );
				}
			});
		},
		updateItem: function(data){
			var id = $('#id').val();
			$.ajax(
				{ url: main_path + '/drivers/'+id, data: data, type: 'PUT',
				success: function( _response ){
					if( _response['status'] == true ){
						Driver.table_body.empty();
						Driver.init();
						Driver.main_modal.modal( 'hide' );
						Driver.eraseModal();
					} else {
						console.log( 'Error' );
						alert( _response );
					}
				}, fail: function( _response ){
					console.log( 'Fail' );
					alert( _response );
				}
			});
		},

		collectData: function(){
			var _name 		= $( '#name' ).val();
			var _last_name 	= $( '#last-name' ).val();
			var token 		= $( '#token' ).val();
			if( _name !== '' && _last_name !== '' && token !== '' )
				return { 
					id: $('#id').val(), 
					name: _name, 
					last_name: _last_name, 
					wage_per_person: 0, 
					wage_per_car: 0, 
					_token: token, 
					alias:$('#alias').val(), 
					address:$('#address').val(),
					phone:$('#phone').val(),
					cellphone:$( '#cellphone' ).val(), 
					number_licence:$('#driver_license').val(),
					end_licence:$('#license_end').val()
				};
			else
				alert( 'Nombre y apellidos es obligatorio' );
			return false;
		}
	}
}();

$(function(){ Driver.init(); Driver.eraseModal(); });