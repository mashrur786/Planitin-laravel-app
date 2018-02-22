/*global jQuery:false */
jQuery(document).ready(function($) {
"use strict";

	//Contact
	$('form.contactForm').submit(function(){
		var result;
		var f = $(this).find('.field'), 
		ferror = false,
		emailExp = /^[^\s()<>@,;:\/]+@\w[\w\.-]+\.[a-z]{2,}$/i,
		teleExp = /^(?:\W*\d){11}\W*$/;

		f.children('input').each(function(){ // run all inputs
            //console.log('input');
			var i = $(this); // current input
			var rule = i.attr('data-rule');

			if( rule !== undefined ){
                var ierror=false; // error flag for current input
                var pos = rule.indexOf( ':', 0 );
                //console.log(pos);
                if( pos >= 0 ){
                    var exp = rule.substr( pos+1, rule.length );
                    rule = rule.substr(0, pos);
                }else{
                    rule = rule.substr( pos+1, rule.length );
                }

                //console.log(exp);
			switch( rule ){
				case 'required':
				if( i.val()==='' ){ ferror=ierror=true; }
				break;
				
				case 'maxlen':
				if( i.val().length>parseInt(exp) ){ ferror=ierror=true; }
				break;

				case 'minlen':
				if( i.val().length<parseInt(exp) ){ ferror=ierror=true; }
				break;

				case 'email':
				if( !emailExp.test(i.val()) ){ ferror=ierror=true; }
				break;

				case 'telephone':
				if( !teleExp.test(i.val()) ){ ferror=ierror=true; }
				break;

				case 'checked':
				if( !i.attr('checked') ){ ferror=ierror=true; }
				break;
				
				case 'regexp':
				exp = new RegExp(exp);
				if( !exp.test(i.val()) ){ ferror=ierror=true; }
				break;
			}

				i.next('.validation').html( ( ierror ? (i.attr('data-msg') !== undefined ? i.attr('data-msg') : 'wrong Input') : '' ) ).show('blind');
				/*var appendData = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">x</span></button>';
				i.next('.validation').append(appendData);*/

			}
		});
		f.children('textarea').each(function(){ // run all inputs
            //console.log('textarea');
			var i = $(this); // current input
			var rule = i.attr('data-rule');

			if( rule !== undefined ){
			var ierror=false; // error flag for current input
			var pos = rule.indexOf( ':', 0 );
			if( pos >= 0 ){
				var exp = rule.substr( pos+1, rule.length );
				rule = rule.substr(0, pos);
			}else{
				rule = rule.substr( pos+1, rule.length );
			}
			
                switch( rule ){
                    case 'required':
                    if( i.val()==='' ){ ferror=ierror=true; }
                    break;

                    case 'maxlen':
                    if( i.val().length<parseInt(exp) ){ ferror=ierror=true; }
                    break;
                }
				i.next('.validation').html( ( ierror ? (i.attr('data-msg') != undefined ? i.attr('data-msg') : 'wrong Input') : '' ) ).show('blind');
				/*var appendData = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">x</span></button>';
				i.next('.validation').append(appendData);*/
			}
		});
		//console.log(ferror);
		if( ferror ) {
			return false
		} else {
			$('.validation').css('display', 'hidden');
			return true;
        }
	});

});