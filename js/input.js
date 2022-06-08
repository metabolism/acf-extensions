;(function($) {

    function loadPreview($layout){

        $layout.find('.acf-fields').hide();
        $layout.find('.acf-flexible-preview-wrapper').show();

        $layout.find('.acf-fc-layout-controls .-edit').show();
        $layout.find('.acf-fc-layout-controls .-preview').hide();

        var $input = $layout.children('input');
        var prefix = $input.attr('name').replace('[acf_fc_layout]', '');

        var flexible = acf.getInstance($layout.closest('.acf-field-flexible-content'));

        var ajaxData = {
            action: 'acf/flexible/layout_preview',
            field_key: flexible.get('key'),
            i: $layout.index(),
            layout: $layout.data('layout'),
            value: acf.serialize($layout, prefix)
        };

        $.post(ajaxurl, ajaxData, function (response){

            $layout.find('.acf-flexible-preview-wrapper').html(response)
        })
    }

    $(document).ready(function (){

        $('.acf-components-collapse').click(function (){

            $(this).closest('.acf-field-flexible-content').find('.layout').addClass('-collapsed')
        });

        $('.acf-components-expand').click(function (){

            $(this).closest('.acf-field-flexible-content').find('.layout').removeClass('-collapsed')
        });

        $('.acf-field-flexible-content').each(function (){

            var $preview = $(this).find('input[name="preview['+$(this).data('key')+']"]')
            var $collapse = $(this).find('input[name="collapse['+$(this).data('key')+']"]')

            if( $collapse.val() === '1'){

                $(this).find('.layout:not(.-collapsed)').slice(1).addClass('-collapsed')

                $(this).on('click', '[data-name="collapse-layout"]', function( e ){

                    var $this = $(e.target);
                    var $layout = $this.closest('.layout');

                    if( !$layout.hasClass('-collapsed') ){

                        $this.closest('.acf-flexible-content').find('.layout').not($layout).addClass('-collapsed');

                        setTimeout(function (){
                            var pos = $layout.offset().top;
                            if( pos-$(window).scrollTop() < 0 )
                                window.scrollTo(0,pos-70)
                        })
                    }
                });
            }

            if( $preview.val() === '1'){

                $(this).addClass('acf-components-preview')

                $(this).find('.layout').each(function (){

                    var $layout = $(this)
                    var $fields = $(this).find('.acf-fields')
                    var $controls = $(this).find('.acf-fc-layout-controls')


                    $controls.prepend('<a class="acf-icon -preview small light acf-js-tooltip dashicons-visibility" title="Afficher l\'apercu"></a>');
                    $controls.prepend('<a class="acf-icon -edit small light acf-js-tooltip dashicons-edit" title="Modifier"></a>');
                    $fields.append('<div class="acf-flexible-opened-actions"><a class="button">Close</a></div>');
                    $fields.after('<div class="acf-flexible-preview-wrapper"></div>');

                    loadPreview($layout);
                });
            }
        });
    })

    $(document).on('click','.acf-flexible-preview-wrapper, .acf-fc-layout-controls .-edit', function (){

        var $layout = $(this).closest('.layout');

        $layout.find('.acf-fc-layout-controls .-edit').hide();
        $layout.find('.acf-fc-layout-controls .-preview').show();

        $(this).hide();
        $layout.find('.acf-fields').show()
    });

    $(document).on('click','.acf-flexible-opened-actions a, .acf-fc-layout-controls .-preview', function (){

        var $layout = $(this).closest('.layout');
        loadPreview($layout);
    });


    var Field = acf.Field.extend({
        type: 'dynamic_select',
        select2: false,
        wait: 'load',
        events: {
            removeField: 'onRemove',
            duplicateField: 'onDuplicate'
        },
        $input: function () {
            return this.$('select');
        },
        initialize: function () {
            // vars
            var $select = this.$input(); // inherit data

            this.inherit($select); // select2

            if (this.get('ui')) {

                this.select2 = acf.newSelect2($select, {
                    field: this,
                    ajax: this.get('ajax'),
                    multiple: this.get('multiple'),
                    placeholder: this.get('placeholder'),
                    allowNull: this.get('allow_null')
                });
            }
        },
        onRemove: function () {
            if (this.select2) {
                this.select2.destroy();
            }
        },
        onDuplicate: function (e, $el, $duplicate) {
            if (this.select2) {
                $duplicate.find('.select2-container').remove();
                $duplicate.find('select').removeClass('select2-hidden-accessible');
            }
        }
    });

    acf.registerFieldType(Field);

})(jQuery);
