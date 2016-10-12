var Validator = function(){
	return {
		valid: true,

		notEmpty: function( vars_ ){
			Validator.valid = true;
			$.each( vars_, function( i, var_ ){
				if( var_ == '' || var_ == false || typeof var_ === 'undefined' )
					Validator.valid = false;
			});
			return Validator.valid;
		}

	}
}();