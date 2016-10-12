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

			$.each( _keys_files, function( i, item ){
				data.append( item, $('#'+item)[0].files[0] );
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
		}
	}
}();