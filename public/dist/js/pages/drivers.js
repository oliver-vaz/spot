var Driver = function(){
	return{
		init: function(){
			$.ajax({
				url: main_path + '/drivers',
				data: {},
				type: 'GET',
				dataType: 'json',
				success: function( _response ){
					_tbody = $('#table-body');
					$.each( _response['drivers'], function( i, item ){
						_tbody.append('<tr><td>' +item[ 'name' ]+'</td><td>'+item['lastname']+
								'</td><td>' + 
								// '<a data-id="' +item[ 'id' ]+ '" class="btn btn-primary">Activar</a>&nbsp' + 
								'<a data-id="' +item[ 'id' ]+ '"class="btn btn-default btn-danger bdelete">Desactivar</a></td></tr>' );
					});
					Driver.assignEvents();
				}
			});
		},

		del: function( id_ ){
			var token = $( '#token' ).val();
			console.log( token );
			$.ajax({
				url: main_path +'/drivers/'+ id_,
				data: { _token : token },
				type: 'DELETE',
				dataType: 'json',
				success: function( _response ){
					console.log( _response );
					_tbody = $('#table-body');
					_tbody.empty();
					Driver.init();					
				}, fail: function( _response ){
					console.log( _response );
				}
			});
		},

		assignEvents: function(){
			$('.bdelete').each( function( i ){
				$(this).unbind( 'click' );
				$(this).click( function(){
					var id = $(this).data( 'id' );
					Driver.del( id );
				});
			});

			$('#send-button').unbind( 'click' );
			$('#send-button').click( function(){
				data = Driver.collectData();
				if( data === false )
					return false;
				$.ajax(
					{ url: main_path + '/drivers', data: data, type: 'POST', dataType: 'json',
					success: function( _response ){
						if( _response['status'] == true ){
							_tbody = $('#table-body');
							_tbody.empty();
							Driver.init();
							$( '#myModal' ).modal( 'hide' );

							$( '#name' ).val( '' );
							$( '#last-name' ).val( '' );

						} else {
							console.log( 'Error' );
							console.log( _response );
						}
					}, fail: function( _response ){
						console.log( 'Fail' );
						console.log( _response );
					}
				});
			});
		},
		collectData: function(){
			var _name 		= $( '#name' ).val();
			var _last_name 	= $( '#last-name' ).val();
			var token 		= $( '#token' ).val();
			if( _name !== '' && _last_name !== '' && token !== '' )
				return { name: _name, last_name: _last_name, wage_per_person: 0, wage_per_car: 0, _token: token };
			else
				alert( 'Todos los campos son obligatorios' );
			return false;
		}
	}
}();

$(function () {

	Driver.init();

});