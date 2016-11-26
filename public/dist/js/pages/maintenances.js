var MaintenanceHandler = function(){
	return {
		init: function(){
			MaintenanceHandler.populateTables();

			$('#send-task').click( function(){
				MaintenanceHandler.sendTask();
			});

			$('#send-maintenance').click( function(){
				MaintenanceHandler.sendMaintenance();
			});
		},
		sendTask: function(){
			var data = InputHandler.collectInfo( [ 'task-name','task-description', 'task-km','_token' ], [], [] );
			$.ajax({ 
				url: main_path + '/tasks', type:'POST', data:data, processData:false, contentType:false,
				success: function( _response ){
					if( _response['status'] != true )
						return false;
					InputHandler.eraseInfo( [ 'task-name','task-description', 'task-km' ], [] ); 
					$( '#modal-task' ).modal( 'hide' );
					MaintenanceHandler.populateTables();
					console.log( _response );
				},

				fail: function( _response ){
					console.log( _response );
					console.log( 'Error' );
				}
			});
		},
		sendMaintenance: function(){
			var data = InputHandler.collectInfo( [ 'm-name','m-comments', '_token' ], [ 'm-car_id', 'm-task_id' ], [] );
			$.ajax({ 
				url: main_path + '/maintenances', type:'POST', data:data, processData:false, contentType:false,
				success: function( _response ){
					if( _response['status'] != true )
						return false;
					InputHandler.eraseInfo( [ 'm-name','m-comments' ], [ 'm-car_id', 'm-task_id' ] ); 
					console.log( _response );
				},

				fail: function( _response ){
					console.log( _response );
					console.log( 'Error' );
				}
			});
		},

		assignEventDelete: function(){
			$.each( $('.btn-danger'), function( i, item ){
				console.log( item );
				$( item ).unbind( 'click' ).click(function(){
					console.log( 'evento' );
					var _id = $( this ).data( 'id' );
					MaintenanceHandler.deleteTask( _id );
				});
			});
		},

		deleteTask: function( id ){
			console.log( id );
			$.ajax({
				url: main_path + '/tasks/' + id, type: 'DELETE',
				data: { '_token' : $('_token').val()  },
				success: function( _response ){
					if( _response['status'] != true )
						return false;
					MaintenanceHandler.populateTables();
				}
			});
		},
		populateTables: function(){
			$.ajax({
				url: main_path + '/tasks', type: 'GET',
				success: function( _response ){
					if( _response['status'] != true )
						return false;
					var _table  = '';
					var _select = '';
					$.each( _response['tasks'], function( i, item ){
						_table += '<tr><td>' + item[ 'name' ] + '</td><td>' + item['km_peridiocity'] + 
									'</td><td><button class="btn btn-danger pull-left" type="button" data-id="' + 
									item['id'] + '"" >Borrar</button> </td></tr>';
						_select += '<option value="' + item[ 'id' ] + '">' + item[ 'name' ] + '</option>';
					});
					$( '#tbody-tasks' ).empty().append( _table );
					$( '#m-task_id' ).empty().append( _select );

					MaintenanceHandler.assignEventDelete();
				},
			});

			$.ajax({
				url: main_path + '/cars', type: 'GET',
				success: function( _response ){
					if( _response['status'] != true )
						return false;
					var html = '';
					$.each( _response['cars'], function( i, item ){
						html += '<option value="' + item[ 'id' ] + '">' + item[ 'modelo' ] + '-' + item[ 'placas' ] + '</option>';
					});
					$( '#m-car_id' ).empty().append( html );
				},
			});
		}
	}
}();

$( function(){
	MaintenanceHandler.init();
});