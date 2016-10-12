var CarHandler = function(){
	return{

		init: function(){
			/* 
			 * Method to reload tables and select-option inputs
			 */
			$.ajax({
				url: main_path + '/cars', data:{}, type:'GET', dataType:'json',
				success: function( _response ){
					if( _response['status'] == false || _response['status'] == 'false' ){
						$('#table-body').empty();
						return false;
					}

					var html = '';
					$.each( _response['cars'], function( i, item ){
						html += '<tr><td>' + item[ 'marca' ]+'</td><td>'+item['modelo']+'</td><td>'+item['placas']+'</td><td>'+item['anio']+
								'</td><td><a data-id="' +item[ 'id' ]+ '" class="btn btn-primary bupdate">Ver/Modificar</a> &nbsp <a data-id="' +item[ 'id' ]+ '"class="btn btn-default btn-danger bdelete">Desactivar</a> &nbsp <a data-id="' +item[ 'id' ]+ '" class="btn btn-default btn-warning bwarning">Nueva Alarma</a></td>    </tr>';
					});
					$('#table-body').empty().append( html );

					CarHandler.assignDeleteEvents();
				}
			});

			$.ajax({   url: main_path + '/drivers', data:{}, type:'GET', dataType:'json',
				success: function( _response ){

					if( _response['status'] == false || _response['status'] == 'false'  ){
						$('#driver-selector').empty();
						$('#u-driver-selector').empty();
						return false;
					}
					var html = '';
					$.each( _response['drivers'], function( i, item ){
						html += '<option value="' + item['id'] + '">' + item['name'] + ' ' + item['lastname']  + '</option>';
					});

					$('#driver-selector').empty().append( html );
					$('#u-driver-selector').empty().append( html );
				}
			});

			CarHandler.assignEvents();
		},

		del: function( id_ ){
			/*
			 * Deleting a Car...
			 */
			var token = $( '#_token' ).val();
			var ans   = confirm( '¿Esta seguro de borrar?' );
			if( !ans ) {
				return false;
			}

			$.ajax({
				url: main_path +'/cars/'+ id_, data: { _token : token }, type: 'DELETE', dataType: 'json',
				success: function( _response ){

					CarHandler.init();					

				}, fail: function( _response ){
					console.log( _response );
				}
			});
		},

		assignDeleteEvents: function(){
			$('.bdelete').each( function(){
				$(this).unbind( 'click' ).click( function(){
					var id = $(this).data( 'id' );
					CarHandler.del( id );
				});
			});

			$('.bupdate').each( function(){
				CarHandler.getCarForUpdate( this );
			});

			$('.bwarning').each( function(){
				$(this).unbind('click').click( function(){
					var id = $(this).data('id');
					$( '#a-id-car' ).val( id );
					$( '#modal-alarm' ).modal( 'show' );

				});
			});

		},

		assignEvents: function(){
			/*
			 * Assigning events, buttons delete item, update item, send information for create and update
			 */
			$('#send-button').unbind( 'click' ).click( function(){
				CarHandler.sendNewCar();
			});

			$('#send-update').unbind( 'click' ).click( function(){
				CarHandler.sendUpdate();
			});

			$('#send-alarm').unbind( 'click' ).click( function(){
				console.log( 'Event' );
				CarHandler.sendAlarm();
			});

			var buttons_update = $('.update-send');
			$.each( buttons_update, function( i, button_car_update ){
				CarHandler.getCarForUpdate( button_car_update );
			});
		},

		sendAlarm: function(){
			data = InputHandler.collectInfo( ['a-title', '_token', 'a-content', 'a-id-car' ], [ 'a-id-task' ], [] );

			$.ajax({
				url: main_path + '/alarms', data:data, type:'POST',processData:false, contentType:false,
				success: function( _response ){
					if( _response['status'] != true ){
						console.log( 'Error' );
						console.log( _response );
						return false;
					}
					$('#modal-alarm').modal( 'hide' );
					InputHandler.eraseInfo([ 'a-title', 'a-content', 'a-id-car' ],[ 'a-id-task' ]);
				},
				fail: function( _response ){
					console.log( 'Error' );
					console.log( _response );
				}
			});
		},

		sendNewCar: function(){
			/*
			 * Collecting data to create a new car
			 */
			data = InputHandler.collectInfo( [ 'brand', 'model', 'placas', 'year', '_token' ], 
											 [ 'year-selector', 'driver-selector' ], [] );
			data.append( 'insurance-price', 0 );
			$.ajax(
				{ url: main_path + '/cars', data: data, type: 'POST', processData:false, contentType:false,
				success: function( _response ){
					if( _response['status'] == true ){
						CarHandler.init();
						$( '#myModal' ).modal( 'hide' );
						InputHandler.eraseInfo([ 'brand', 'model', 'placas', 'year' ], 
											 [ 'year-selector', 'driver-selector' ] );
						return true;
					}
					console.log( 'Error' );
					console.log( _response );
				}, fail: function( _response ){
					console.log( 'Fail' );
					console.log( _response );
				}
			});
		},

		/* Possible code error, maybe i going to need a closure*/
		getCarForUpdate: function( button_update ){
			/*
			 * Getting information about a car to update data
			 */
			$( button_update ).unbind( 'click' ).click( function(){
				var id = $( this ).data('id');
				$.ajax({
					url: main_path + '/cars/withdata/' + id,
					data: '',
					type: 'GET',
					success: function( _response ){
						if( _response['status'] != true ){
							console.log( _response['status'] );
							console.log( typeof _response['status'] );
							console.log( 'Error' );
						}
						CarHandler.populateModalUpdate( _response['car'], _response['assignment'] );
						$( '#modal-update' ).modal( 'show' );
					}, fail: function( _response ){
						console.log( 'Error' );
						console.log( _response );
					}
				});
			});
		},

		populateModalUpdate: function( _car, _assignment ){
			/*
			 * Just populating data in a modal...
			 */
			$('#u-id').val( _car.id );
			$('#u-brand').val( _car.marca );
			$('#u-model').val( _car.modelo );
			$('#u-placas').val( _car.placas );
			$('#u-km').val( _car.km );
			$('#u-year').val( _car.anio );
			$("#u-driver-selector").val( _assignment.driver_id );
		},

		sendUpdate: function(){
			/*
			 * Sending info to update a record...
			 */
			var data = InputHandler.collectInfo( 
				[ 'u-id', 'u-brand', 'u-model', 'u-placas', 'u-km', '_token' ],
				['u-driver-selector', 'u-year' ],[] );
			data.append( 'u-insurance-price', 0 );

			$.ajax({
				url: main_path + '/cars/update/' + $('#u-id').val(),
				data: data,
				type: 'POST',
				processData:false, contentType:false,
				success: function( _response ){
					if( _response['status'] != true ){
						console.log( 'Error' );
						console.log( _response);
					}
					InputHandler.eraseInfo(
						[ 'u-id', 'u-brand', 'u-model', 'u-placas', 'u-year' ],
						['u-driver-selector']
					);
					$('#modal-update').modal('hide');
					CarHandler.init();
				},
				fail: function( _response ){
					console.log( 'Error' );
					console.log( _response);
				}

			});
		}

	} //END OF RETURN
}();

$(function () {
	CarHandler.init();
});