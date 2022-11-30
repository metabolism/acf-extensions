;(function($) {

    $(document).ready(function (){

        $('.acf-components-collapse').click(function (){

            $(this).closest('.acf-field-flexible-content').find('.layout').addClass('-collapsed')
        });

        $('.acf-components-expand').click(function (){

            $(this).closest('.acf-field-flexible-content').find('.layout').removeClass('-collapsed')
        });

        $('.acf-field-flexible-content').each(function (){

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
        });
    })

    acf.fields.textarea_counter = acf.field.extend({
        type: 'textarea',

        events: {
            'input textarea': 'change_count',
        },

        change_count: function(e){

            var $input = e.$el.closest('.acf-input');
            var max = $input.find('.char-count').data('max');

            if (typeof(max) == 'undefined')
                return;

            var value = e.$el.val();
            var $count = $input.find('.count')

            $count.text(value.length);

            if( value.length > max )
                $count.addClass('count--more')
            else
                $count.removeClass('count--more')
        },

    });

    acf.fields.text_counter = acf.field.extend({
        type: 'text',

        events: {
            'input input': 'change_count',
        },

        change_count: function(e){
            var $input = e.$el.closest('.acf-input');
            var max = $input.find('.char-count').data('max');

            if (typeof(max) == 'undefined')
                return;

            var value = e.$el.val();
            var $count = $input.find('.count')

            $count.text(value.length);

            if( value.length > max )
                $count.addClass('count--more')
            else
                $count.removeClass('count--more')
        },

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
