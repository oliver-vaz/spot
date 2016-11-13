var DashboardHandler = function(){
	return {
		init: function(){
			$.each( $('.close' ), function( i, item ){
				$(item).click( function(){
					var id = $(this).data('id');
					var token = $('#token').val();
					if( confirm( 'Esta seguro de desactivar la alarma?' ) )
						DashboardHandler.delete( id, token );
					else 
						return false;
				});
			});
		},
		delete: function( id, token ){
			console.log( id );
			console.log( token );
			$.ajax({
				url: main_path + '/alarms/' + id ,
				type: 'DELETE',
				data: { "_token": token },
				success: function( _response ){
					if( _response['status'] != true ){
						console.log('Error');
						return false;
					}
					console.log( _response );
				}, fail: function( _response ){
					console.log( 'Error!!' );
					console.log( _response );
				}
			});
		}
}}();

$( function(){
	DashboardHandler.init();
});