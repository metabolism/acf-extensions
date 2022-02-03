;(function($) {

    // Hide options group
    $('#is_acf_component_checkbox').on('change', function() {

        if($(this).is(":checked")) {
            $("#acf-field-group-locations, #acf-field-group-options").addClass('is-acf-component');
        } else {
            $("#acf-field-group-locations, #acf-field-group-options").removeClass('is-acf-component');
        }

    }).trigger('change');

})(jQuery);
