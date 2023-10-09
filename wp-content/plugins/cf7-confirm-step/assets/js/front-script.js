/***************************************************************************
 *
 * FRONT SCRIPT JS
 *
 ***************************************************************************/
(function($) {
$(document).ready(function() {
    
    document.addEventListener( 'wpcf7submit', function( event ) {
        let status = event.detail.status;
        let formwrap_id = event.detail.unitTag;
        let message = event.detail.apiResponse.message;
        let $inputWrap = $('#'+formwrap_id+' .'+cf7cfstep_forminput_class);
        let $confirmWrap = $('#'+formwrap_id+' .'+cf7cfstep_formconfirm_class);
        let $responseWrap = $('#'+formwrap_id+' .wpcf7-response-output');
        let ipt_name = '';
        if( status && status == 'aborted' && message && message == cf7cfstep_gostep2_key ) {
            // HIDE RESPONSE MESSAGE
            $responseWrap.addClass('cf7cfstep-hide');

            // SET INPUT STEP 2
            $('input[name="cf7cfstep_num"]').val(2);

            // SET CONFIRM DATA
            let form_data = event.detail.inputs;
            if( form_data ) {
                for (var i = 0; i < form_data.length; i++) {
                    let form_item_value = form_data[i].value;
                    if ( typeof form_item_value == 'object' ) {
                        form_item_value = form_item_value.name;
                    }
                    $('span[wpcf7-data-name="'+form_data[i].name+'"]').text(form_item_value);
                }
            }
            // SHOW CONFIRM STEP
            $inputWrap.addClass('cf7cfstep-hide');
            $confirmWrap.removeClass('cf7cfstep-hide');
            $('html,body').animate({
                scrollTop: $('.areaContact .listSteps').offset().top - 50
            }, 1000);

            // SET CLASS STEP 2 IN BODY
            $('body').addClass('form-is-step2');
        } else {
            $responseWrap.removeClass('hide-response');
        }

        $('.areaContact .btnSubmit input').removeClass('cf-disabled');
    }, false );


    // EVENT BUTTON BACK WPCF7
    $('body').on('click', '.wpcf7-form-control.wpcf7-submit', function(event){
        $('.areaContact .btnSubmit input').addClass('cf-disabled');
    });


    // EVENT BUTTON BACK WPCF7
    $('body').on('click', '.wpcf7-form-control.wpcf7-back', function(event){
        $(this).closest('.cf7cfstep-confirm-step-wrap').find($('input[name="cf7cfstep_num"]')).val(1);
        $(this).closest('.cf7cfstep-confirm-step-wrap').addClass('cf7cfstep-hide');
        $(this).closest('.cf7cfstep-confirm-step-wrap').prev().removeClass('cf7cfstep-hide');
        $('html,body').animate({
            scrollTop: $('.areaContact .listSteps').offset().top - 50
        }, 1000);
        // REMOVE CLASS STEP 2 IN BODY
        $('body').removeClass('form-is-step2');
    });


    document.addEventListener( 'wpcf7mailsent', function( event ) {
        $('.wpcf7-response-output').removeClass('cf7cfstep-hide');
        $('.areaContact .btnSubmit input').removeClass('cf-disabled');
    });

    document.addEventListener( 'wpcf7mailfailed', function( event ) {
        $('.wpcf7-response-output').removeClass('cf7cfstep-hide');
        $('.areaContact .btnSubmit input').removeClass('cf-disabled');
    });

    document.addEventListener( 'wpcf7spam', function( event ) {
        $('.wpcf7-response-output').removeClass('cf7cfstep-hide');
        $('.areaContact .btnSubmit input').removeClass('cf-disabled');
    });



});
})(jQuery);
