var InputHandler = function(){
	return {

		collectInfo: function( _keys_inputs, _keys_selects, _keys_files ){
			var data = new FormData();
			$.each( _keys_inputs, function( i, item  ){
				data.append( item, $( '#' + item ).val() );
			});

			$.each( _keys_selects, function( i, item  ){
				data.append( item, $( "#" +  item + " option:selected" ).val() );
			});

			if( _keys_files.lenght > 0 )
				$.each( _keys_files, function( i, item ){
					data.append( item, $('#'+item)[0].files[0] );
				});

			return data;
		},

		collectInfoInContext: function( context, _keys_inputs, _keys_selects, _keys_files ){
			var data = new FormData();
			$.each( _keys_inputs, function( i, item  ){
				data.append( item, $( '#' + item, context ).val() );
			});

			$.each( _keys_selects, function( i, item  ){
				data.append( item, $( "#" +  item + " option:selected", context ).val() );
			});

			if( _keys_files.lenght > 0 )
				$.each( _keys_files, function( i, item ){
					data.append( item, $('#'+item)[0].files[0], context );
				});

			return data;
		},

		eraseInfo: function( _keys_input, _key_selects ){
			$.each( _keys_input, function( i, item  ){
				$( '#' + item ).val( '' );
			});
			$.each( _key_selects, function( i, item  ){
				$( "#" +  item + " option:selected" ).prop( 'checked', false );
			});
		},

		eraseInfoInContext: function( context, _keys_input, _key_selects ){
			$.each( _keys_input, function( i, item  ){
				$( '#' + item, context ).val( '' );
			});
			$.each( _key_selects, function( i, item  ){
				$( "#" +  item + " option:selected", context ).prop( 'checked', false );
			});
		}

	}
}();