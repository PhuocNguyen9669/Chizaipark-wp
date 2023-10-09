/***************************************************************************
 *
 * ADMIN SCRIPT JS
 *
 ***************************************************************************/
(function($) {
$(document).ready(function() {


    //CUSTOM INSERT TAB CONFIRM
    $( 'input.insert-tag-confirm' ).click( function() {
        var $form = $( this ).closest( 'form.tag-generator-panel' );
        var tag = $form.find( 'input.tag' ).val();
        wpcf7.taggen.insert_confirm( tag );
        tb_remove(); // close thickbox
        return false;
    } );


    wpcf7.taggen.insert_confirm = function( content ) {
        $( 'textarea#cf7cfstep-confirm' ).each( function() {
            this.focus();
            if ( document.selection ) { // IE
                var selection = document.selection.createRange();
                selection.text = content;
            } else if ( this.selectionEnd || 0 === this.selectionEnd ) {
                var val = $( this ).val();
                var end = this.selectionEnd;
                $( this ).val( val.substring( 0, end ) +
                    content + val.substring( end, val.length ) );
                this.selectionStart = end + content.length;
                this.selectionEnd = end + content.length;
            } else {
                $( this ).val( $( this ).val() + content );
            }

            this.focus();
        } );
    };


    $('body').on('change', '#cf7cfstep-panel input[type="checkbox"].custom_css_checkbox', function(){
        $('#wpcf7-admin-form-element').submit();
    });
});
})(jQuery);
