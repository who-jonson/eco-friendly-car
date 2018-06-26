jQuery.validator.addMethod("alphanumeric", function(value, element) {
    return this.optional( element ) || /^[a-zA-Z0-9]+$/.test( value );
}, "User name must be alphanumeric(a-z, A-Z, 0-9).");
//Admin update profile
$(document).ready( function () {
    $( "#adminUpdateProfile" ).validate( {
        rules: {
            name: 'required',
            email: {
                required: true,
                email: true
            },
            user_name: {
                required: true,
                minlength: 4,
                alphanumeric: true
            }
        },
        messages: {
            name: 'Please Provide your full name',
            email: {
                required: "Please provide your email",
                email: "Please provide a valid email"
            },
            user_name: {
                required: "Please enter a username",
                minlength: "Your username must consist of at least 4 characters",
                alphanumeric: "User name must be alpha numeric"
            }
        },
        errorElement: "em",
        errorPlacement: function ( error, element ) {
            // Add the `help-block` class to the error element
            error.addClass( "help-block" );

            // Add `has-feedback` class to the parent div.form-group
            // in order to add icons to inputs
            element.parents( ".col-sm-9" ).addClass( "has-feedback" );

            if ( element.prop( "type" ) === "checkbox" ) {
                error.insertAfter( element.parent( "label" ) );
            } else {
                error.insertAfter( element );
            }

            // Add the span element, if doesn't exists, and apply the icon classes to it.
            if ( !element.next( "span" )[ 0 ] ) {
                $( "<span class='glyphicon glyphicon-remove form-control-feedback'></span>" ).insertAfter( element );
            }
        },
        success: function ( label, element ) {
            // Add the span element, if doesn't exists, and apply the icon classes to it.
            if ( !$( element ).next( "span" )[ 0 ] ) {
                $( "<span class='glyphicon glyphicon-ok form-control-feedback'></span>" ).insertAfter( $( element ) );
            }
        },
        highlight: function ( element, errorClass, validClass ) {
            $( element ).parents( ".col-sm-9" ).addClass( "has-error" ).removeClass( "has-success" );
            $( element ).next( "span" ).addClass( "glyphicon-remove" ).removeClass( "glyphicon-ok" );
        },
        unhighlight: function ( element, errorClass, validClass ) {
            $( element ).parents( ".col-sm-9" ).addClass( "has-success" ).removeClass( "has-error" );
            $( element ).next( "span" ).addClass( "glyphicon-ok" ).removeClass( "glyphicon-remove" );
        }
    } );
} );

//Admin update password
$(document).ready( function () {
    $( "#adminUpdatePassword" ).validate( {
        rules: {
            old_pass: {
                required: true,
                minlength: 6
            },
            new_pass: {
                required: true,
                minlength: 6
            },
            conf_new_pass: {
                required: true,
                minlength: 6,
                equalTo: "#new-pass"
            }
        },
        messages: {
            old_pass: {
                required: "Please provide your old password",
                minlength: "Password must be at least 6 characters long."
            },
            new_pass: {
                required: "Please provide your new password",
                minlength: "Password must be at least 6 characters long."
            },
            conf_new_pass: {
                required: "Please confirm your new password",
                minlength: "Password must be at least 6 characters long.",
                equalTo: "Password did not match"
            }
        },
        errorElement: "em",
        errorPlacement: function ( error, element ) {
            // Add the `help-block` class to the error element
            error.addClass( "help-block" );

            // Add `has-feedback` class to the parent div.form-group
            // in order to add icons to inputs
            element.parents( ".col-sm-9" ).addClass( "has-feedback" );

            if ( element.prop( "type" ) === "checkbox" ) {
                error.insertAfter( element.parent( "label" ) );
            } else {
                error.insertAfter( element );
            }

            // Add the span element, if doesn't exists, and apply the icon classes to it.
            if ( !element.next( "span" )[ 0 ] ) {
                $( "<span class='glyphicon glyphicon-remove form-control-feedback'></span>" ).insertAfter( element );
            }
        },
        success: function ( label, element ) {
            // Add the span element, if doesn't exists, and apply the icon classes to it.
            if ( !$( element ).next( "span" )[ 0 ] ) {
                $( "<span class='glyphicon glyphicon-ok form-control-feedback'></span>" ).insertAfter( $( element ) );
            }
        },
        highlight: function ( element, errorClass, validClass ) {
            $( element ).parents( ".col-sm-9" ).addClass( "has-error" ).removeClass( "has-success" );
            $( element ).next( "span" ).addClass( "glyphicon-remove" ).removeClass( "glyphicon-ok" );
        },
        unhighlight: function ( element, errorClass, validClass ) {
            $( element ).parents( ".col-sm-9" ).addClass( "has-success" ).removeClass( "has-error" );
            $( element ).next( "span" ).addClass( "glyphicon-ok" ).removeClass( "glyphicon-remove" );
        }
    } );
} );