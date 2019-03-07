<?php 

//Get saved themeoption value
if(!function_exists('composer_get_option_value')){

	function composer_get_option_value( $key, $default, $replace_site_url = false ) {

		if( is_customize_preview() ) {		
			$value = get_theme_mod( $key, $default );
			return $replace_site_url ? 
					str_replace( '[site_url]', get_home_url(), $value ) : 
					$value;
			return $value;
		}

		global $smof_data;

		$value = isset($smof_data[$key]) ? $smof_data[$key] : $default;

		return $value;
	}

}
