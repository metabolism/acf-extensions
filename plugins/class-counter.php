<?php
if( ! class_exists('acf_counter') ) :

    class acf_counter {

        public function __construct() {
            add_action('acf/render_field/type=text', 		array($this, 'render_field'), 20, 1);
            add_action('acf/render_field/type=textarea', 	array($this, 'render_field'), 20, 1);
            add_action('acf/render_field/type=inline_editor', 	array($this, 'render_field'), 20, 1);
        } // end public function __construct

        private function run() {
            // cannot run on field group editor or it will
            // add code to every ACF field in the editor
            $run = true;

            global $post;

            if ($post && $post->ID && get_post_type($post->ID) == 'acf-field-group')
                $run = false;

            return $run;
        } // end private function run


        public function render_field($field) {

            if (!$this->run() || (!$field['maxlength']??false && !$field['maxlength_hint']??false) || ($field['type'] != 'text' && $field['type'] != 'textarea' && $field['type'] != 'inline_editor'))
                return;

            $len = acf_strlen($field['value']);

            $max = $field['maxlength_hint']??$field['maxlength'];

            $classes 	= apply_filters('acf-input-counter/classes', array());
            $ids 		= apply_filters('acf-input-counter/ids', array());

            $insert = true;

            if (count($classes) || count($ids)) {

                $exist = array();

                if ($field['wrapper']['class'])
                    $exist = explode(' ', $field['wrapper']['class']);

                $insert = $this->check($classes, $exist);

                if (!$insert && $field['wrapper']['id']) {

                    $exist = array();

                    if ($field['wrapper']['id'])
                        $exist = explode(' ', $field['wrapper']['id']);

                    $insert = $this->check($ids, $exist);
                }
            } // end if filter classes or ids

            if (!$insert)
                return;

            $display = sprintf(
                __('%1$s/%2$s', 'acf-counter'),
                '%%len%%',
                '%%max%%'
            );

            $display = apply_filters('acf-input-counter/display', $display);
            $display = str_replace('%%len%%', '<span class="count">'.$len.'</span>', $display);
            $display = str_replace('%%max%%', '<span>'.$max.'</span>', $display);
            ?>
            <span class="char-count" data-max="<?=$max?>"><?=$display?></span>
            <?php
        } // end public function render_field

        private function check($allow, $exist) {
            // if there is anything in $allow
            // see if any of those values are in $exist
            $intersect = array_intersect($allow, $exist);

            if (count($intersect))
                return true;

            return false;
        } // end private function check

} // end class acf_counter
    new acf_counter();

endif;