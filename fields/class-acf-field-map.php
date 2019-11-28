<?php

if( ! class_exists('acf_field_map_extension') ) :

	class acf_field_map_extension {

		/**
		 * When saving map, save also country and iso
		 * @param $value
		 * @param int $post_id
		 * @param array $field
         * @return mixed
         */
        public function updateValue($value, $post_id=0, $field=array()){

            if( $field['type'] == 'google_map' ){

                if( isset($value['address']) && !empty($value['address']) ){

                    if( !isset($value['country_short']) ){

                        $google_api_key = acf_get_setting('google_api_key');

                        $url = 'https://maps.googleapis.com/maps/api/geocode/json?latlng='.$value['lat'].','.$value['lng'].'&sensor=false&key='.$google_api_key.'&result_type=country';
                        $data = json_decode(file_get_contents($url), true);

                        if($data && isset($data['results']) && count($data['results']) ){

                            $result = $data['results'][0];

                            if( isset($result['address_components']) && count( $result['address_components'])){

                                $address = $result['address_components'][0];

                                $value['country'] = $address['long_name'];
                                $value['iso'] = $address['short_name'];
                                $value['country_short'] = $address['short_name'];
                            }
                        }
                    }
                    else{
                        //add retro compat
                        $value['iso'] = $value['country_short'];
                    }
                }
            }

            return $value;
        }

		/**
		 * On load, check if country and iso exists else get it from google
		 * @param $value
		 * @param int $post_id
		 * @param array $field
		 * @return mixed
		 */
		public function loadValue($value, $post_id=0, $field=array()){

			if( $field['type'] == 'google_map' ){

			    if( isset($value['address']) && !empty($value['address']) ){

			        if( isset($value['country']) && isset($value['country_short']) & !isset($value['iso']) ){
			            //add retro compat
                        $value['iso'] = $value['country_short'];
                    }
			        elseif( !isset($value['country']) ){

                        $google_api_key = acf_get_setting('google_api_key');

                        $url = 'https://maps.googleapis.com/maps/api/geocode/json?latlng='.$value['lat'].','.$value['lng'].'&sensor=false&key='.$google_api_key.'&result_type=country';
                        $data = json_decode(file_get_contents($url), true);

                        if($data && isset($data['results']) && count($data['results']) ){

                            $result = $data['results'][0];

                            if( isset($result['address_components']) && count( $result['address_components'])){

                                $address = $result['address_components'][0];

                                $value['country'] = $address['long_name'];
                                $value['country_short'] = $address['short_name'];
                                $value['iso'] = $address['short_name'];

                                acf_update_metadata( $post_id, $field['name'], $value );
                                acf_update_metadata( $post_id, $field['name'], $field['key'], true );
                                acf_flush_value_cache( $post_id, $field['name'] );
                            }
                        }
                    }
                }
			}

			return $value;
		}

		public function __construct()
		{
			add_filter('acf/update_value', [$this, 'updateValue'], 10, 3);
			add_filter('acf/load_value', [$this, 'loadValue'], 10, 3);
		}
	}

	new acf_field_map_extension();

endif; // class_exists check
