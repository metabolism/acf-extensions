;(function($) {

    function wpse_getLink() {
        var _ed = window.tinymce.get( window.wpActiveEditor );
        if ( _ed && ! _ed.isHidden() ) {
            return _ed.dom.getParent( _ed.selection.getNode(), 'a[href]' );
        }
        return null;
    }

    // add collapse / expand all on flexible field
    $(document).ready(function (){

        /**
         * Modify link attributes to include aria label
         */
        if( typeof wpLink !== 'undefined' ){

            wpLink.getAttrs = function() {

                wpLink.correctURL();

                return {
                    'aria-label' : $.trim( $( '#wp-link-aria_label' ).val() ),
                    'href'       : $.trim( $( '#wp-link-url' ).val() ),
                    'target'     : $( '#wp-link-target' ).prop( 'checked' ) ? '_blank' : ''
                };
            }
        }
    })

    // add new aria label field
    $(document).on( 'wplink-open', function( wrap ) {

        // Custom HTML added to the link dialog
        if( $('#wp-link-aria_label').length < 1 )
            $('#link-options .link-target').before( '<div class="wp-link-text-field"><label><span>Aria label</span> <input type="text" id="wp-link-aria_label"/></label></div>');

        // Get the current link selection:
        var _node = wpse_getLink();

        if( _node ) {

            // Fetch the rel attribute
            var _aria_label = $( _node ).attr( 'aria-label' );

            // Update the checkbox
            $('#wp-link-aria_label').val( _aria_label );
        }
        else{

            $('#wp-link-aria_label').val('');
        }

    });

    acf.field.extend({
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
        }
    });

    acf.field.extend({
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
        }
    });

    acf.field.extend({
        type: 'link',
        events: {
            'click a[data-name="add"]': 'onClickEdit',
            'click a[data-name="edit"]': 'onClickEdit',
            'change .link-node': 'onChange'
        },

        onClickEdit: function (e) {
            var $input = e.$el.closest('.acf-input');

            if( !$input.find('.input-aria_label').length ){

                let name = $input.find('.input-title').attr('name');
                $input.find('.acf-hidden').append('<input type="hidden" class="input-aria_label" name="'+name.replace('[title]', '[aria_label]')+'" value="">')
            }

            $('#wp-link-aria_label').val( $input.find('.input-aria_label').val() )
        },
        onChange: function (e) {

            var $input = e.$el.closest('.acf-input');

            if( $('#wp-link-aria_label').length && $input.find('.input-aria_label').length)
                $input.find('.input-aria_label').val( $('#wp-link-aria_label').val() )
        }
    });

    var dynamicSelect = acf.Field.extend({
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

    acf.registerFieldType(dynamicSelect);

    var inlineEditor = acf.Field.extend({
        type: 'inline_editor',
        wait: 'load',
        events: {
            removeField: 'onRemove',
            duplicateField: 'onDuplicate'
        },
        change_count: function($input){
            var max = $input.find('.char-count').data('max');

            if (typeof(max) == 'undefined')
                return;

            var value = $input.find('.acf-input-inline-editor').text();
            var $count = $input.find('.count')

            $count.text(value.length);

            if( value.length > max )
                $count.addClass('count--more')
            else
                $count.removeClass('count--more')
        },
        initialize: function () {

            var $input = this.$input(); // inherit data
            var $parent = $input.closest('.acf-field');
            var self = this;
            var $target = $parent.find('.acf-input-inline-editor')

            if( !$target.length )
                return;

            var inline = new inLine('#'+$target.attr('id'),{
                output: '#'+$input.attr('id'),
                toolbar: $input.data('toolbar').split(','),
                colors: $input.data('colors')?$input.data('colors').split(','):'',
                onChange: function (api) {
                    self.change_count($parent)
                    $input.change()
                }
            });

            $target.bind("paste", function(e){

                e.preventDefault();

                // get text representation of clipboard
                var text = (e.originalEvent || e).clipboardData.getData('text/plain');

                // insert text manually
                document.execCommand("insertHTML", false, text);
            });

            $input.data('inline', inline)
        },
        onRemove: function () {

            var $input = this.$input(); // inherit data
            var inline = $input.data('inline')

            if( inline )
                inline.destroy();
        },
        onDuplicate: function (e, $el, $duplicate) {

        }
    });

    acf.registerFieldType(inlineEditor);

})(jQuery);
