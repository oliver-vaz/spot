var Customer = function(){
	return{

		init: function(){
			$('#send-button').unbind( 'click' ).click( function(){
				Customer.buttonSendCustomer();
			});

			$( '#send-tariff' ).unbind( 'click' ).click( function(){
				Customer.buttonSendTariff();
			});

			$( '#send-location' ).unbind( 'click' ).click( function(){
				Customer.buttonSendLocation();
			});
			Customer.loadCustomers();
		},

		loadCustomers: function(){
			var tbody    = $('#table-body');
			var location = $('#location-selector');
			var tariff   = $('#tariff-selector');
			Customer.deleteNodes( tbody, location, tariff );

			$.ajax({
				url: main_path + '/customers', 
				data: {},
				type: 'GET',
				dataType: 'json',
				success: function( _response ){
					var _str_table 	 = ''
					var _str_options = '';

					$.each( _response['customers'], function( i, item ){
						_str_table += '<tr><td>'+item[ 'rfc' ]+'</td><td>'+item['short_name']+ '<td>'+item[ 'address' ]+'</td>' +
								'</td><td><a data-id="' +item[ 'id' ]+ '"class="btn btn-default btn-danger bdelete">Desactivar</a></td></tr>';
						_str_options += '<option value="'+ item['id'] +'">'+item['short_name']+'</option>';
					});

					tbody.append( _str_table );
					location.append(_str_options ); 
					tariff.append( _str_options );
					Customer.assignDynamicEvents();
				}
			});
		},

		deleteNodes: function( tbody, location, tariff ){
			tbody.empty();
			location.empty();
			tariff.empty();
		},

		del: function( id_ ){
			var _data = InputHandler.collectInfo( ['_token'], [] );
			$.ajax({
				url: main_path +'/customers/'+ id_,
				data: _data ,
				type: 'DELETE',
				dataType: 'json',
				success: function( _response ){
					console.log( _response );
					Customer.loadCustomers();
				}, fail: function( _response ){
					console.log( _response );
				}
			});
		},

		assignDynamicEvents: function(){
			$('.bdelete').each( function( i ){
				$(this).unbind( 'click' );
				$(this).click( function(){
					var id = $(this).data( 'id' );
					Customer.del( id );
				});
			});
		},

		buttonSendCustomer: function(){

			var data = InputHandler.collectInfo( [ 'name', 'shortname', 'rfc', 'phone', 'cellphone', 'alterphone',
				'address', 'zipcode', 'city', '_token' ], [] );
			$.ajax(
				{ url: main_path + '/customers', data: data, type: 'POST', dataType: 'json',

				success: function( _response ){
					if( _response['status'] == true ){
						console.log( 'Dato almacenado' );
						_tbody = $('#table-body');
						_tbody.empty();
						Customer.loadCustomers();
						$( '#myModal' ).modal( 'hide' );
						InputHandler.eraseInfo( [ 'name', 'shortname', 'rfc', 'phone', 'cellphone', 
							'alterphone', 'address', 'zipcode' , 'city' ], []);

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

		buttonSendTariff: function(){
			var data = InputHandler.collectInfo( 
				[ 'car-price', 'person-price', 'init-date', 'tarrif-checkbox', '_token' ], 
				[ 'tariff-selector' ] );

			$.ajax( { url: main_path + '/customers/tariff', data: data, type: 'POST', dataType: 'json',
				success: function( _response ){
					if( _response['status'] == true ){
						console.log( _response );
						$( '#modal-tariffs' ).modal( 'hide' );
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

		buttonSendLocation: function(){
			var data = InputHandler.collectInfo( 
				[ 'location-name', 'location-address', '_token' ], 
				[ 'location-selector' ] );

			$.ajax( { url: main_path + '/customers/location', data: data, type: 'POST', dataType: 'json',
				success: function( _response ){
					if( _response['status'] == true ){
						console.log( _response );
						$( '#modal-locations' ).modal( 'hide' );
					} else {
						console.log( 'Error' );
						console.log( _response );
					}
				}, fail: function( _response ){
					console.log( 'Fail' );
					console.log( _response );
				}
			});
		}

	}//RETURN END!!!
}();

$(function () {

	Customer.init();


});