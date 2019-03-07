<?php
/*
	Register Fonts
	*/
	function composer_theme_fonts_url() {

		global $smof_data;

		$font_url = '';

		if (!is_admin()) {

			$protocol = is_ssl() ? 'https' : 'http';

			//Subset
			$raw_subsets = (isset($smof_data['subset'])) ? $smof_data['subset'] : array("latin" => 1);

			$font_subsets = '';
			foreach( $raw_subsets as $key => $value ) {
				if( $value == '1' || $value == '0' ){
					if( $value == '1' ) {
						$font_subsets .= $key .',';
					}
				}
				else {
					$font_subsets .= $value .',';
				}
			}
			$font_subsets = rtrim($font_subsets, ",");

			$custom_fonts = array();
			$user_fonts = composer_get_option_value('custom_fonts', array() );

			if( !empty( $user_fonts ) ) {
				foreach ( $custom_fonts as $font ) {

					if( $font['font_title'] && ( $font['woff'] || $font['ttf'] || $font['eot'] || $font['svg'] ) ) {
						$custom_fonts[] = $font['font_title'];
					}

				}
			}

			//Advanced font Settings
			$afs = isset($smof_data['ad_font_settings']) ? $smof_data['ad_font_settings'] : '0';

			$body_font = $headings_font = '';

			//Body Font
			if( (isset($smof_data['custom_font_body']['g_face'])) && ! in_array($smof_data['custom_font_body']['g_face'], $custom_fonts) ) {
				$body_font = (isset($smof_data['custom_font_body']['g_face'])) ? $smof_data['custom_font_body']['g_face'] : 'Raleway';
				$body_font .= ':300,400,400italic,700,700italic';
			}

			//Heading Font
			if( (isset($smof_data['custom_font_primary']['g_face'])) && ! in_array($smof_data['custom_font_primary']['g_face'], $custom_fonts) ) {
				$headings_font = (isset($smof_data['custom_font_primary']['g_face'])) ? '|'.$smof_data['custom_font_primary']['g_face'] : '|Poppins';
				$headings_font .= ':300,400,500,600,700';
			}

			if($afs == '0'){ 

				/*
				Translators: If there are characters in your language that are not supported
				by chosen font(s), translate this to 'off'. Do not translate into your own language.
				 */

				if ( 'off' !== _x( 'on', 'Google font: on or off', 'composer' ) ) {
					$font_url = add_query_arg( 'family', urlencode($body_font.$headings_font.'&subset='. $font_subsets), "//fonts.googleapis.com/css" );
				}
			}
			else { // it runs only advance typography option is turned on

				$h1 = $h2 = $h3 = $h4 = $h5 = $h6 = $list = $link = $logo = $blockquote = $menu = $sub_menu = $mega_menu = $main_title = $btn = $btn_small = $btn_lg = $process_title = $process_content = $percent_text = $percent_outside = $txtfield = $staff_title = $filter_normal = $plan_title = $plan_value = $plan_valign = $plan_month = $testimonial_content = $widget_title = $cf_twitter = '';

				//H1 Custom Font				
				if( (isset($smof_data['cf_h1']['g_face'])) && ! in_array($smof_data['cf_h1']['g_face'], $custom_fonts) ) {
					$h1 = (isset($smof_data['cf_h1']['g_face'])) ? '|'.$smof_data['cf_h1']['g_face'] : '';
					$h1 .= (isset($smof_data['cf_h1']['style'])) ? ':'.$smof_data['cf_h1']['style'] : '';
				}

				//H2 Custom Font
				if( (isset($smof_data['cf_h2']['g_face'])) && ! in_array($smof_data['cf_h2']['g_face'], $custom_fonts) ) {
					$h2 = (isset($smof_data['cf_h2']['g_face'])) ? '|'.$smof_data['cf_h2']['g_face'] : '';
					$h2 .= (isset($smof_data['cf_h2']['style'])) ? ':'.$smof_data['cf_h2']['style'] : '';
				}

				//H3 Custom Font
				if( (isset($smof_data['cf_h3']['g_face'])) && ! in_array($smof_data['cf_h3']['g_face'], $custom_fonts) ) {
					$h3 = (isset($smof_data['cf_h3']['g_face'])) ? '|'.$smof_data['cf_h3']['g_face'] : '';
					$h3 .= (isset($smof_data['cf_h3']['style'])) ? ':'.$smof_data['cf_h3']['style'] : '';
				}

				//H4 Custom Font
				if( (isset($smof_data['cf_h4']['g_face'])) && ! in_array($smof_data['cf_h4']['g_face'], $custom_fonts) ) {
					$h4 = (isset($smof_data['cf_h4']['g_face'])) ? '|'.$smof_data['cf_h4']['g_face'] : '';
					$h4 .= (isset($smof_data['cf_h4']['style'])) ? ':'.$smof_data['cf_h4']['style'] : '';
				}

				//H5 Custom Font
				if( (isset($smof_data['cf_h5']['g_face'])) && ! in_array($smof_data['cf_h5']['g_face'], $custom_fonts) ) {
					$h5 = (isset($smof_data['cf_h5']['g_face'])) ? '|'.$smof_data['cf_h5']['g_face'] : '';
					$h5 .= (isset($smof_data['cf_h5']['style'])) ? ':'.$smof_data['cf_h5']['style'] : '';
				}

				//H6 Custom Font
				if( (isset($smof_data['cf_h6']['g_face'])) && ! in_array($smof_data['cf_h6']['g_face'], $custom_fonts) ) {
					$h6 = (isset($smof_data['cf_h6']['g_face'])) ? '|'.$smof_data['cf_h6']['g_face'] : '';
					$h6 .= (isset($smof_data['cf_h6']['style'])) ? ':'.$smof_data['cf_h6']['style'] : '';
				}

				//List Item Font
				if( (isset($smof_data['cf_list']['g_face'])) && ! in_array($smof_data['cf_list']['g_face'], $custom_fonts) ) {
					$list = (isset($smof_data['cf_list']['g_face'])) ? '|'.$smof_data['cf_list']['g_face'] : '';
					$list .= (isset($smof_data['cf_list']['style'])) ? ':'.$smof_data['cf_list']['style'] : '';
				}

				//Link Font
				if( (isset($smof_data['cf_link']['g_face'])) && ! in_array($smof_data['cf_link']['g_face'], $custom_fonts) ) {
					$link = (isset($smof_data['cf_link']['g_face'])) ? '|'.$smof_data['cf_link']['g_face'] : '';
					$link .= (isset($smof_data['cf_link']['style'])) ? ':'.$smof_data['cf_link']['style'] : '';
				}

				//Logo Font
				if( (isset($smof_data['cf_logo']['g_face'])) && ! in_array($smof_data['cf_logo']['g_face'], $custom_fonts) ) {
					$logo = (isset($smof_data['cf_logo']['g_face'])) ? '|'.$smof_data['cf_logo']['g_face'] : '';
					$logo .= (isset($smof_data['cf_logo']['style'])) ? ':'.$smof_data['cf_logo']['style'] : '';
				}

				//BlockQuote Font
				if( (isset($smof_data['cf_blockquote']['g_face'])) && ! in_array($smof_data['cf_blockquote']['g_face'], $custom_fonts) ) {
					$blockquote = (isset($smof_data['cf_blockquote']['g_face'])) ? '|'.$smof_data['cf_blockquote']['g_face'] : '';
					$blockquote .= (isset($smof_data['cf_blockquote']['style'])) ? ':'.$smof_data['cf_blockquote']['style'] : '';
				}

				//Menu Font
				if( (isset($smof_data['cf_menu']['g_face'])) && ! in_array($smof_data['cf_menu']['g_face'], $custom_fonts) ) {
					$menu = (isset($smof_data['cf_menu']['g_face'])) ? '|'.$smof_data['cf_menu']['g_face'] : '';
					$menu .= (isset($smof_data['cf_menu']['style'])) ? ':'.$smof_data['cf_menu']['style'] : '';
				}

				//Sub Menu Font
				if( (isset($smof_data['cf_sub_menu']['g_face'])) && ! in_array($smof_data['cf_sub_menu']['g_face'], $custom_fonts) ) {
					$sub_menu = (isset($smof_data['cf_sub_menu']['g_face'])) ? '|'.$smof_data['cf_sub_menu']['g_face'] : '';
					$sub_menu .= (isset($smof_data['cf_sub_menu']['style'])) ? ':'.$smof_data['cf_sub_menu']['style'] : '';
				}

				//Mega Menu Font
				if( (isset($smof_data['cf_mega_menu']['g_face'])) && ! in_array($smof_data['cf_mega_menu']['g_face'], $custom_fonts) ) {
					$mega_menu = (isset($smof_data['cf_mega_menu']['g_face'])) ? '|'.$smof_data['cf_mega_menu']['g_face'] : '';
					$mega_menu .= (isset($smof_data['cf_mega_menu']['style'])) ? ':'.$smof_data['cf_mega_menu']['style'] : '';
				}

				//Main Title Font
				if( (isset($smof_data['cf_main_title']['g_face'])) && ! in_array($smof_data['cf_main_title']['g_face'], $custom_fonts) ) {
					$main_title = (isset($smof_data['cf_main_title']['g_face'])) ? '|'.$smof_data['cf_main_title']['g_face'] : '';
					$main_title .= (isset($smof_data['cf_main_title']['style'])) ? ':'.$smof_data['cf_main_title']['style'] : '';
				}

				//Button Font
				if( (isset($smof_data['cf_btn']['g_face'])) && ! in_array($smof_data['cf_btn']['g_face'], $custom_fonts) ) {
					$btn = (isset($smof_data['cf_btn']['g_face'])) ? '|'.$smof_data['cf_btn']['g_face'] : '';
					$btn .= (isset($smof_data['cf_btn']['style'])) ? ':'.$smof_data['cf_btn']['style'] : '';
				}

				//Small Button Font
				if( (isset($smof_data['cf_btn_small']['g_face'])) && ! in_array($smof_data['cf_btn_small']['g_face'], $custom_fonts) ) {
					$btn_small = (isset($smof_data['cf_btn_small']['g_face'])) ? '|'.$smof_data['cf_btn_small']['g_face'] : '';
					$btn_small .= (isset($smof_data['cf_btn_small']['style'])) ? ':'.$smof_data['cf_btn_small']['style'] : '';
				}

				//Large Button Font
				if( (isset($smof_data['cf_btn_lg']['g_face'])) && ! in_array($smof_data['cf_btn_lg']['g_face'], $custom_fonts) ) {
					$btn_lg = (isset($smof_data['cf_btn_lg']['g_face'])) ? '|'.$smof_data['cf_btn_lg']['g_face'] : '';
					$btn_lg .= (isset($smof_data['cf_btn_lg']['style'])) ? ':'.$smof_data['cf_btn_lg']['style'] : '';
				}

				//Process Title Font
				if( (isset($smof_data['cf_process_title']['g_face'])) && ! in_array($smof_data['cf_process_title']['g_face'], $custom_fonts) ) {
					$process_title = (isset($smof_data['cf_process_title']['g_face'])) ? '|'.$smof_data['cf_process_title']['g_face'] : '';
					$process_title .= (isset($smof_data['cf_process_title']['style'])) ? ':'.$smof_data['cf_process_title']['style'] : '';
				}

				//Process Content Font
				if( (isset($smof_data['cf_process_content']['g_face'])) && ! in_array($smof_data['cf_process_content']['g_face'], $custom_fonts) ) {
					$process_content = (isset($smof_data['cf_process_content']['g_face'])) ? '|'.$smof_data['cf_process_content']['g_face'] : '';
					$process_content .= (isset($smof_data['cf_process_content']['style'])) ? ':'.$smof_data['cf_process_content']['style'] : '';
				}

				//Percent Text Font
				if( (isset($smof_data['cf_percent_text']['g_face'])) && ! in_array($smof_data['cf_percent_text']['g_face'], $custom_fonts) ) {
					$percent_text = (isset($smof_data['cf_percent_text']['g_face'])) ? '|'.$smof_data['cf_percent_text']['g_face'] : '';
					$percent_text .= (isset($smof_data['cf_percent_text']['style'])) ? ':'.$smof_data['cf_percent_text']['style'] : '';
				}

				//Percent Outside Font
				if( (isset($smof_data['cf_percent_outside']['g_face'])) && ! in_array($smof_data['cf_percent_outside']['g_face'], $custom_fonts) ) {
					$percent_outside = (isset($smof_data['cf_percent_outside']['g_face'])) ? '|'.$smof_data['cf_percent_outside']['g_face'] : '';
					$percent_outside .= (isset($smof_data['cf_percent_outside']['style'])) ? ':'.$smof_data['cf_percent_outside']['style'] : '';
				}

				//Textfield Font
				if( (isset($smof_data['cf_txtfield']['g_face'])) && ! in_array($smof_data['cf_txtfield']['g_face'], $custom_fonts) ) {
					$txtfield = (isset($smof_data['cf_txtfield']['g_face'])) ? '|'.$smof_data['cf_txtfield']['g_face'] : '';
					$txtfield .= (isset($smof_data['cf_txtfield']['style'])) ? ':'.$smof_data['cf_txtfield']['style'] : '';
				}

				//Staff Title Font
				if( (isset($smof_data['cf_staff_title']['g_face'])) && ! in_array($smof_data['cf_staff_title']['g_face'], $custom_fonts) ) {
					$staff_title = (isset($smof_data['cf_staff_title']['g_face'])) ? '|'.$smof_data['cf_staff_title']['g_face'] : '';
					$staff_title .= (isset($smof_data['cf_staff_title']['style'])) ? ':'.$smof_data['cf_staff_title']['style'] : '';
				}

				//Portfolio Filter Normal Font
				if( (isset($smof_data['cf_filter_normal']['g_face'])) && ! in_array($smof_data['cf_filter_normal']['g_face'], $custom_fonts) ) {
					$filter_normal = (isset($smof_data['cf_filter_normal']['g_face'])) ? '|'.$smof_data['cf_filter_normal']['g_face'] : '';
					$filter_normal .= (isset($smof_data['cf_filter_normal']['style'])) ? ':'.$smof_data['cf_filter_normal']['style'] : '';
				}

				//Pricing Table Title Font
				if( (isset($smof_data['cf_plan_title']['g_face'])) && ! in_array($smof_data['cf_plan_title']['g_face'], $custom_fonts) ) {
					$plan_title = (isset($smof_data['cf_plan_title']['g_face'])) ? '|'.$smof_data['cf_plan_title']['g_face'] : '';
					$plan_title .= (isset($smof_data['cf_plan_title']['style'])) ? ':'.$smof_data['cf_plan_title']['style'] : '';
				}

				//Pricing Table Price Font
				if( (isset($smof_data['cf_plan_value']['g_face'])) && ! in_array($smof_data['cf_plan_value']['g_face'], $custom_fonts) ) {
					$plan_value = (isset($smof_data['cf_plan_value']['g_face'])) ? '|'.$smof_data['cf_plan_value']['g_face'] : '';
					$plan_value .= (isset($smof_data['cf_plan_value']['style'])) ? ':'.$smof_data['cf_plan_value']['style'] : '';
				}

				//Pricing Table Currency Font
				if( (isset($smof_data['cf_plan_valign']['g_face'])) && ! in_array($smof_data['cf_plan_valign']['g_face'], $custom_fonts) ) {
					$plan_valign = (isset($smof_data['cf_plan_valign']['g_face'])) ? '|'.$smof_data['cf_plan_valign']['g_face'] : '';
					$plan_valign .= (isset($smof_data['cf_plan_valign']['style'])) ? ':'.$smof_data['cf_plan_valign']['style'] : '';
				}

				//Pricing Table Plan Month Font
				if( (isset($smof_data['cf_plan_month']['g_face'])) && ! in_array($smof_data['cf_plan_month']['g_face'], $custom_fonts) ) {
					$plan_month = (isset($smof_data['cf_plan_month']['g_face'])) ? '|'.$smof_data['cf_plan_month']['g_face'] : '';
					$plan_month .= (isset($smof_data['cf_plan_month']['style'])) ? ':'.$smof_data['cf_plan_month']['style'] : '';
				}

				//Testimonial Content Font
				if( (isset($smof_data['cf_testimonial_content']['g_face'])) && ! in_array($smof_data['cf_testimonial_content']['g_face'], $custom_fonts) ) {
					$testimonial_content = (isset($smof_data['cf_testimonial_content']['g_face'])) ? '|'.$smof_data['cf_testimonial_content']['g_face'] : '';
					$testimonial_content .= (isset($smof_data['cf_testimonial_content']['style'])) ? ':'.$smof_data['cf_testimonial_content']['style'] : '';
				}

				//Widget Title Font
				if( (isset($smof_data['cf_widget_title']['g_face'])) && ! in_array($smof_data['cf_widget_title']['g_face'], $custom_fonts) ) {
					$widget_title = (isset($smof_data['cf_widget_title']['g_face'])) ? '|'.$smof_data['cf_widget_title']['g_face'] : '';
					$widget_title .= (isset($smof_data['cf_widget_title']['style'])) ? ':'.$smof_data['cf_widget_title']['style'] : '';
				}

				//Twitter Content Font
				if( (isset($smof_data['cf_twitter']['g_face'])) && ! in_array($smof_data['cf_twitter']['g_face'], $custom_fonts) ) {
					$cf_twitter = (isset($smof_data['cf_twitter']['g_face'])) ? '|'.$smof_data['cf_twitter']['g_face'] : '';
					$cf_twitter .= (isset($smof_data['cf_twitter']['style'])) ? ':'.$smof_data['cf_twitter']['style'] : '';
				}

				/*
				Translators: If there are characters in your language that are not supported
				by chosen font(s), translate this to 'off'. Do not translate into your own language.
				 */

				if ( 'off' !== _x( 'on', 'Google font: on or off', 'composer' ) ) {
					$font_url = add_query_arg( 'family', urlencode($body_font.$headings_font.$h1.$h2.$h3.$h4.$h5.$h6.$list.$link.$logo.$blockquote.$menu.$sub_menu.$mega_menu.$main_title.$btn.$btn_small.$btn_lg.$process_title.$process_content.$percent_text.$percent_outside.$txtfield.$staff_title.$filter_normal.$plan_title.$plan_value.$plan_valign.$plan_month.$testimonial_content.$widget_title.$cf_twitter .'&subset='. $font_subsets), "//fonts.googleapis.com/css" );
				}
			}


		}	    
		
		return $font_url;
	}
	/*
	Enqueue scripts and styles.
	*/
	function composer_theme_fonts_scripts() {
		wp_enqueue_style( 'pix_theme_fonts', composer_theme_fonts_url(), array(), '1.0.0' );
	}
	add_action( 'wp_enqueue_scripts', 'composer_theme_fonts_scripts' );

	//Seperate font weight & font Style

	if(!function_exists('composer_font_variant')){
		function composer_font_variant($fv = ''){

			//Font Style
			if(stristr($fv, 'italic') !== FALSE){
				$fs = 'italic';
			}else{
				$fs = 'normal';
			}

			//Font Weight
			$fw = substr($fv, 0, 3);
			if($fw === FALSE || $fw == 'reg' || $fw == 'ita'){
				$fw = '400';
			}

			return array($fs, $fw);
		}
	}

	function composer_get_font_family( $font ) {

		$ff = '';
		// Choosen Google webfont
		if( isset( $font['g_face'] ) ){
			$ff = $font['g_face'];
		} elseif( isset( $font['font-family'] ) )  {
			$ff = $font['font-family'];
		}

		return $ff;

	}

	function composer_get_font_style( $font ) {

		$fv = '';
		// Google web font variant (eg; 300italic)
		if( isset( $font['style'] ) ){
			$fv = $font['style'];
		} elseif( isset( $font['variant'] ) )  {
			$fv = $font['variant'];
		}

		return $fv;

	}

	function composer_get_font_size( $font ) {

		$fsize = '';
		// Font size
		if( isset( $font['size'] ) ){
			$fsize = $font['size'];
		} elseif( isset( $font['font-size'] ) )  {
			$fsize = $font['font-size'];
		}

		return $fsize;
	}

	function composer_get_font_fallback( $font ) {
		$ff = isset( $font['face'] ) ? $font['face'] : ''; // Fallback font
		return $ff;
	}

	// Title Bar
	if( ! function_exists( 'composer_sub_banner' ) ) {

		function composer_sub_banner( $id = '', $echo = true ) {

			// Empty assignment
			$html = $class_con = $class_left = $class_right = '';

			$prefix = composer_get_prefix();

			// Page Title
			$title = composer_get_page_title();

			$title_bar = composer_get_meta_value( $id, '_amz_title_bar', 'default', 'title_bar', 'show' ); // id, meta_key, meta_default, themeoption_key, themeoption_default

			$title_bar_size = composer_get_meta_value( $id, '_amz_title_bar_size', 'default', 'title_bar_size', 'small' ); // id, meta_key, meta_default, themeoption_key, themeoption_default

			$title_bar_style = composer_get_meta_value( $id, '_amz_title_bar_style', 'default', 'title_bar_style', 'default' ); // id, meta_key, meta_default, themeoption_key, themeoption_default

			$breadcrumbs = composer_get_meta_value( $id, '_amz_breadcrumbs', 'default', 'breadcrumbs', 'show' ); // id, meta_key, meta_default, themeoption_key, themeoption_default

			$header_layout = composer_get_meta_value( $id, '_amz_header_layout', 'default', 'header_layout', 'header-1' ); // id, meta_key, meta_default, themeoption_key, themeoption_default

			$transparent_header = composer_get_meta_value( $id, '_amz_transparent_header', 'default', 'transparent_header', 'hide' ); // id, meta_key, meta_default, themeoption_key, themeoption_default

			$overlay = composer_get_meta_value( $id, '_amz_title_bar_overlay', 'default', 'title_bar_overlay', 'color' ); // id, meta_key, meta_default, themeoption_key, themeoption_default			

			$overlay_color = composer_get_meta_value( $id, '_amz_title_bar_overlay_color', 'default', 'title_bar_overlay_color', '' ); // id, meta_key, meta_default, themeoption_key, themeoption_default

			$gradient1 = composer_get_meta_value( $id, '_amz_title_bar_gradient_top_value', 'default', 'title_bar_gradient_top_value', '' ); // id, meta_key, meta_default, themeoption_key, themeoption_default

			$gradient2 = composer_get_meta_value( $id, '_amz_title_bar_gradient_middle_value', 'default', 'title_bar_gradient_middle_value', '' ); // id, meta_key, meta_default, themeoption_key, themeoption_default

			$gradient3 = composer_get_meta_value( $id, '_amz_title_bar_gradient_bottom_value', 'default', 'title_bar_gradient_bottom_value', '' ); // id, meta_key, meta_default, themeoption_key, themeoption_default

			$overlay_opacity = composer_get_meta_value( $id, '_amz_title_bar_gradient_opacity', 'default', 'title_bar_gradient_opacity', '0.9' ); // id, meta_key, meta_default, themeoption_key, themeoption_default

			$title_tag = composer_get_option_value( 'title_bar_title_tag', 'h2' );

			$header_layout = 'sub-'.$header_layout;

			$header_text = ( $title_bar_size == 'small' ) ? 'left' : 'center';

			if( $header_text == 'left' ){
				$class_left = 'col-md-8 col-sm-8';
				$class_right = 'col-md-4 col-sm-4';
				$class_con = 'row';
			}

			$transparent_header_class = ( 'show' === $transparent_header ) ? 'header-trans' : '';

			if( 'show' == $title_bar ) {
				
				$html .= '<div id="sub-header" class="clear '. esc_attr( $header_layout .' '. $transparent_header_class .' clearfix align-'. $header_text .' '. $title_bar_size .' '. $title_bar_style ) .'" >';
					
					if( $overlay == 'color' && !empty( $overlay_color ) ){
						$html .= '<div class="pattern"></div>';
					}
					elseif( $overlay == 'gradient' && ( !empty( $gradient1 ) || !empty( $gradient2 ) || !empty( $gradient3 ) ) ){
						$html .= '<div class="pattern"></div>';
					}

					$html .= '<div class="container">';
						$html .= '<div id="banner" class="sub-header-inner '.$class_con.'">';

							$html .= '<header class="banner-header '. $class_left .'">';
								$html .= '<'. composer_title_tag( $title_tag ) .' class="sub-banner-title">' . esc_html( $title ) . '</'. composer_title_tag( $title_tag ) .'>';
							$html .= '</header>';

							if( 'show' === $breadcrumbs ){

								$html .= '<div class="pix-breadcrumbs '. esc_attr( $class_right ) .'">';

									// Breadcrumbs
									$html .= composer_breadcrumbs( false ); // echo

								$html .= '</div>';
							}

						$html .= '</div>';

					$html .= '</div>';

				$html .= '</div>';

			}

			// Pass sub banner values for filter
			$value = array();

			$value['prefix']             = $prefix;
			$value['title']              = $title;
			$value['title_bar']          = $title_bar;
			$value['title_bar_size']     = $title_bar_size;
			$value['title_bar_style']    = $title_bar_style;
			$value['breadcrumbs']        = $breadcrumbs;
			$value['header_layout']      = $header_layout;
			$value['transparent_header'] = $transparent_header;
			$value['overlay']            = $overlay;
			$value['overlay_color']      = $overlay_color;
			$value['gradient1']          = $gradient1;
			$value['gradient2']          = $gradient2;
			$value['gradient3']          = $gradient3;
			$value['overlay_opacity']    = $overlay_opacity;

			$html = apply_filters( 'composer_sub_banner_html', $html, $value );

			if( $echo ) {
				echo $html;
			}
			else {
				return $html;
			}
			
		}
	}
	

// Breadcrumbs
if( ! function_exists( 'composer_breadcrumbs' ) ) {
	
	function composer_breadcrumbs( $echo = true ) {

		global $post;

		// Useful variables
		$delimiter = ''; // delimiter between crumbs
		$home = composer_get_option_value( 'breadcrumbs_prefix', esc_html__( 'Home', 'composer' ) );
		$before = '<span class="current">'; // tag before the current crumb
		$after = '</span>'; // tag after the current crumb

		$title = composer_get_page_title();

		$homeLink = home_url( '/' );

		ob_start();

		
			if ( is_home() ) {
				echo '<ul class="breadcrumb"><li><a href="' . esc_url( home_url( '/' ) ) . '">'. esc_html( ucwords( $home ) ) .'</a></li><li>'. $before . esc_html( $title ) . $after .'</span></li></ul>';
			}
			else if( composer_is_shop() || composer_is_product() || composer_is_product_category() || composer_is_product_tag() ) {
				woocommerce_breadcrumb();
			}
			else {

				echo '<ul class="breadcrumb"><li><a href="' . esc_url( $homeLink ) . '">'. esc_html( ucwords( $home ) ) .'</a> ' . $delimiter . '</li>';

					if ( is_category() ) {
						global $wp_query;
						$cat_obj = $wp_query->get_queried_object(); 
						$this_cat = $cat_obj->term_id;
						$this_cat = get_category( $this_cat );
						$parent_cat = get_category( $this_cat->parent );
						if ( $this_cat->parent != 0 ) {
							echo '<li>' . $before . get_category_parents( $parent_cat, TRUE, ' ' . $delimiter . ' ' ) . $after .'</li>';
						}
						echo '<li>' . $before . esc_html( single_cat_title( '', false ) ) . $after .'</li>';

					}
					else if ( is_search() ) {
						echo '<li>' . $before . esc_html( get_search_query() ) . $after .'</li>';

					}
					else if ( is_day() ) {
						echo '<li><a href="' . esc_url( get_year_link( get_the_time( 'Y' ) ) ) . '">' . esc_html( get_the_time( 'Y' ) ) . '</a> ' . $delimiter . '</li>';
						echo '<li><a href="' . esc_url( get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) ) . '">' . esc_html( get_the_time('F') ) . '</a> ' . $delimiter . '</li>';
						echo '<li>' . $before . esc_html( get_the_time('d') ) . $after . '</li>';

					}
					else if ( is_month() ) {
						echo '<li><a href="' . esc_url( get_year_link( get_the_time( 'Y' ) ) ) . '">' . esc_html( get_the_time('Y') ) . '</a> ' . $delimiter . '</li>';
						echo '<li>' . $before . esc_html( get_the_time('F') ) . $after . '</li>';

					}
					else if ( is_year() ) {
						echo '<li>' . $before . esc_html( get_the_time('Y') ) . $after . '</li>';

					}
					else if ( is_single() && !is_attachment() ) {
						if ( get_post_type() != 'post' ) {

							if ( is_singular( 'pix_portfolio' ) ){

								// Get portfolio page ID
								$portfolio_page = composer_get_option_value( 'portfolio_page', '' );

								$post_type = get_post_type_object( get_post_type() );

								if( 'dashboard' != $portfolio_page && ! empty( $portfolio_page ) ) {
									$portfolio_page_url = get_permalink( $portfolio_page );
								}

								if( ! empty( $portfolio_page_url ) ) {
									echo '<li><a href="' . esc_url( $portfolio_page_url ) . '">' . esc_html( ucwords( $post_type->labels->singular_name ) ) . '</a> ' . $delimiter . '</li>';
								}
								else {
									echo '<li><span>' . esc_html( ucwords( $post_type->labels->singular_name ) ) . $delimiter . '</span></li>';
								}
								
							}

							$post_type = get_post_type_object(get_post_type());
							$slug = $post_type->rewrite;
							
							global $wp_query; 
							$post_id = ( 0 == get_the_ID() || NULL == get_the_ID() ) ? $wp_query->post->ID : get_the_ID();

							echo '<li> ' . $before . ucwords( esc_html( get_the_title( $post_id ) ) ) . $after . '</li>';

						}
						else {
							if ( is_singular( 'post' ) ) {

								$blog_page_title = composer_get_option_value( 'blog_page_title', esc_html__( 'Blog', 'composer' ) );
								$blog_page_id = get_option( 'page_for_posts' );

								echo '<li><a href="'. esc_url( get_permalink( $blog_page_id ) ) .'">'. $before . ucwords( $blog_page_title ) . $after . '</a></li>';
							}
							
							echo '<li>'. $before . ucwords( composer_shorten_text( esc_html( get_the_title() ), 40 ) ) . $after . '</li>';
						}

					}
					else if ( !is_single() && !is_page() && get_post_type() != 'post' && !composer_is_shop() && !composer_bbp_is_user_home() && !is_404() ) {

						$post_type = get_post_type_object( get_post_type() );
						echo '<li>'. $before . esc_html( ucwords( $post_type->labels->singular_name ) ) . $after.'</li>';

						if( is_tax() ) {
							$current_term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );

							echo '<li>'. $before . esc_html( ucwords( $current_term->name ) ) . $after.'</li>';
						}				

					}
					else if( composer_bbp_is_user_home() ) {
						echo '<li>'. $before . esc_html__( 'User', 'composer' ) . $after.'</li>';
					}
					else if ( is_attachment() ) {
						$parent = get_post( $post->post_parent );
						$cat = get_the_category( $parent->ID ); 
						if(!empty($cat)){
							$cat = $cat[0];
							echo get_category_parents( $cat, TRUE, ' ' . $delimiter . ' ' );
						}
						echo '<li><a href="' . esc_url( get_permalink( $parent ) ) . '">' . esc_html( ucwords( $parent->post_title ) ) . '</a></li>';
						
						echo '<li>' . $delimiter . ' ' . $before . ucwords( esc_html( get_the_title() ) ) . $after . '</li>';

					} 
					elseif ( is_page() && !$post->post_parent ) {
						echo '<li>' . $before . ucwords( esc_html( get_the_title() ) ) . $after .'</li>';

					}
					elseif ( is_page() && $post->post_parent ) {
						$parent_id  = $post->post_parent;
						$breadcrumbs = array();
						while ($parent_id) {
							$page = get_page( $parent_id );
							$breadcrumbs[] = '<li><a href="' . esc_url( get_permalink( $page->ID ) ) . '">' . esc_html( ucwords( get_the_title( $page->ID ) ) ) . '</a></li>';
							$parent_id  = $page->post_parent;
						}
						$breadcrumbs = array_reverse( $breadcrumbs );
						for ( $i = 0; $i < count( $breadcrumbs ); $i++ ) {
							echo $breadcrumbs[$i]; //escaped Properly on five lines before from here
							if ( $i != count( $breadcrumbs ) -1 ) {
								echo ' ' . $delimiter . ' ';
							}
						}
						echo '<li>' . $delimiter . ' ' . $before . ucwords( esc_html(get_the_title() ) ) . $after . '</li>';

					}
					elseif ( is_tag() ) {
						echo '<li>' . $before . esc_html__( 'Posts Tag: ', 'composer' ) . esc_html( ucwords(single_tag_title('', false) . '') ) . $after . '</li>';

					}
					elseif ( is_author() ) {
						global $author;
						$userdata = get_userdata($author);
						echo '<li>' .$before . esc_html__( 'Posted By: ', 'composer' ) . esc_html( ucwords($userdata->display_name ) ) . $after .'</li>';

					}
					elseif ( is_404() ) {
						echo '<li>' .$before . esc_html__('Error 404', 'composer' ) . $after .'</li>';
					}

					if ( get_query_var( 'paged' ) ) {
						if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) {
							echo ' (';
								echo esc_html__(' - Page', 'composer' ) . ' ' . get_query_var( 'paged' );
							echo ')';
						}
					}

				echo '</ul>';

			}

		$html = ob_get_contents();
		ob_end_clean();


		// Pass breadcrumbs values for filter
		$value = array();

		$value['delimiter'] = $delimiter;
		$value['home']      = $home;
		$value['home_link'] = $homeLink;
		$value['before']    = $before;
		$value['after']     = $after;

		$html = apply_filters( 'composer_breadcrumbs_html', $html, $value );

		if( $echo ) {
			echo $html;
		}
		else {
			return $html;
		}
	}

}

/* WPML */
function composer_languages_list(){
	if( class_exists( 'SitePress' ) ){
	
		global $smof_data;

		$show_lang_sel = isset($smof_data['show_lang_sel'])? $smof_data['show_lang_sel'] : 'no';

		if( 'yes' === $show_lang_sel ){
			$lang_display_style = isset($smof_data['wpml_lang_style'])? $smof_data['wpml_lang_style'] : 'normal'; //normal, dropdown
			$lang_list_style = isset($smof_data['language_style'])? $smof_data['language_style'] : 'lang_code'; // lang_code (en / fr / ta), lang_name (english, tamil, french), flag, flag_with_name
			$skip_missing_lang = isset($smof_data['skip_missing_lang'])? $smof_data['skip_missing_lang'] : 'yes';

			if( 'yes' === $skip_missing_lang ) {
				$skip_missing_lang = '1';
			} else {
				$skip_missing_lang = '0';
			}

			$languages = icl_get_languages('skip_missing='.$skip_missing_lang.'&orderby=custom');

			$lang_count = count($languages);
			$count = 1;

			if(1 < $lang_count){
				$trans_status = esc_html__('translated', 'composer' );			
			}else{
				$trans_status = esc_html__('not-translated', 'composer' );
			}

			if(!empty($languages)){
				echo '<div id="lang-list" class="lang-'. $lang_display_style .' '. $lang_list_style .' '. $trans_status .'" >';
				if($lang_display_style == 'dropdown'){
						//Check If Drop-down Add Current
						if($lang_display_style == 'dropdown'){

							echo '<div id="lang-dropdown-btn">';
								foreach($languages as $l){
									if($l['active']){
										if($lang_list_style == 'lang_code'){
											echo esc_html( $l['language_code'] );
										}elseif ($lang_list_style == 'lang_name') {
											echo icl_disp_language( $l['native_name'], $l['translated_name'] );
										}elseif ($lang_list_style == 'flag') {
											if($l['country_flag_url']){
												echo '<img src="'. esc_url( $l['country_flag_url'] ) .'" height="12" alt="'. esc_attr( $l['language_code'] ).'" width="18" />';
											}
										}else{
											if($l['country_flag_url']){
												echo '<img src="'. esc_url( $l['country_flag_url'] ) .'" height="12" alt="'.esc_attr( $l['language_code'] ) .'" width="18" />';
												echo ' ' . icl_disp_language($l['native_name'], $l['translated_name']);
											}
										}
										break;
									}
								}
							if(1 < $lang_count){	
								echo '<span class="pixicon-arrow-angle-down"></span></div>';
							}
							else{
								echo '<span class="already-liked">'. esc_html__('Not Translated','composer' ) .'</span></div>';
							}
						}

					echo '<div class="lang-dropdown-inner">';
				}

				foreach($languages as $l){

					if($l['active']){
						$active_class = ' class="active"';
					}else{
						$active_class = '';
					}
					// lang_code(en / fr / ta)
					if($lang_list_style == 'lang_code'){

						echo '<a href="'.esc_url($l['url']).'"'. $active_class .'>';
						echo esc_html( $l['language_code'] );
						echo '</a>';

						if($count != $lang_count && $lang_display_style != 'dropdown'){
							echo '<span class="slash">/</span>';
						}

					}
					 // lang_name (english, tamil, french)
					elseif ($lang_list_style == 'lang_name') {

						echo '<a href="'.esc_url($l['url']).'"'. $active_class .'>';
						echo icl_disp_language($l['native_name'], $l['translated_name']);
						echo '</a>';

						if($count != $lang_count && $lang_display_style != 'dropdown'){
							echo '<span class="slash">/</span>';
						}
					}
					// display flag
					elseif ($lang_list_style == 'flag'){

						if($l['country_flag_url']){
							echo '<a href="'.esc_url($l['url']).'"'. $active_class .'>';
							echo '<img src="'.esc_url($l['country_flag_url']).'" height="12" alt="'. esc_attr( $l['language_code'] ) .'" width="18" />';
							echo '</a>';
						}
					}
					// flag with name
					elseif($lang_list_style == 'flag_with_name'){
						
						if($l['country_flag_url']){
							echo '<a href="'.esc_url($l['url']).'"'. $active_class .'>';
							echo '<img src="'.esc_url($l['country_flag_url']).'" height="12" alt="'. esc_attr( $l['language_code'] ) .'" width="18" />';
							echo ' ' . icl_disp_language($l['native_name'], $l['translated_name']);
							echo '</a>';
						}
				
					}
					$count++;
				}

				if($lang_display_style == 'dropdown'){
					echo '</div>';
				}
				echo '</div>';
			}
		}
	}
}	

if( ! function_exists( 'composer_get_page_title' ) ) {	
	function composer_get_page_title() {

		// Post ID
		if ( composer_is_shop() ) {
			$post_id = wc_get_page_id( 'shop' );
		}
		else if( is_home() || is_archive() || is_search() || is_404() ) {
			$post_id = get_option('page_for_posts');
		}		
		else {
			global $wp_query; 
			$post_id = ( 0 == get_the_ID() || NULL == get_the_ID() ) ? $wp_query->post->ID : get_the_ID();
		}

		// Post title
		if( composer_is_shop() ) {
			$page_title = get_the_title( $post_id );
		}
		else if ( composer_is_product_category() ) {
			$page_title = single_cat_title( '', false );
		}
		else if( is_post_type_archive( 'tribe_events' ) ) {
			$page_title = composer_get_option_value( 'event_tribe_page_title', esc_html__( 'Calendar', 'composer' ) );
		}
		else if( composer_bbp_is_user_home() ) {
			$page_title = esc_html( get_the_title( $post_id ) );
		}
		else if( is_home() ) {
			$page_title = composer_get_option_value( 'blog_page_title', esc_html__( 'Blog', 'composer' ) );
		}
		else if( is_category() ) {
			$page_title = esc_html__('Posts Categorized:', 'composer' ) . ' ' . single_cat_title( $prefix = '', $display = false );
		}
		else if( is_tag() ) { 
			$page_title = esc_html__('Posts Tagged:', 'composer' ) . ' ' . single_tag_title( $prefix = '', $display = false );
		}
		else if( is_author() ) { 
			global $post;
			$author_id = $post->post_author;

			$page_title = esc_html__('Posts By:', 'composer' ) . ' ' . get_the_author_meta('display_name', $author_id);

		}
		else if ( is_day() ) { 
			$page_title = esc_html__('Daily Archives:', 'composer' ) . ' ' . get_the_time('l, F j, Y');
		}
		else if ( is_month() ) {  
			$page_title = esc_html__('Monthly Archives:', 'composer' ) . ' ' . get_the_time('F Y');
		}
		else if ( is_year() ) {  
			$page_title = esc_html__('Posts Categorized:', 'composer' ) . ' ' . get_the_time('Y');
		}
		else if ( is_search() ) {  
			$page_title = esc_html__('Search Result: ', 'composer' ) .get_search_query();
		}
		else if ( is_404() ) {  
			$page_title = esc_html__('404 Error', 'composer' );
		}
		else if ( ! is_single() && ! is_page() && get_post_type() != 'post' ) {

			$post_type = get_post_type_object( get_post_type() );

			if ( isset($post_type->labels->singular_name ) ) {
				$page_title = esc_html( ucwords( $post_type->labels->singular_name ) );
			}
			else {
				$page_title = esc_html( get_the_title( $post_id ) );
			}
		}		
		else {  
			$page_title = esc_html( get_the_title( $post_id ) );
		}

		return $page_title;
	}
}

//Sidebar
if( !function_exists( 'composer_sidebar' ) ){

	function composer_sidebar( $sidebar_name , $default ){
		echo '<div id="aside" class="sidebar col-md-3">';
			if ( is_active_sidebar( $sidebar_name ) ){
				dynamic_sidebar( $sidebar_name );
			}
			elseif( $sidebar_name == 0 ){

				if ( is_active_sidebar( $default ) ){
					dynamic_sidebar( $default );
				}
				else{
					echo '<p class="sidebar-info">'. esc_html__('Please active sidebar widget or disable it from theme option.', 'composer' ).'</p>';
				}
			}
		echo '</div>';

	}
}

/*
 * Function: Feature Thumbnail
 * Version : 2.1
 */

if( ! function_exists( 'composer_featured_thumbnail' ) ) {

	function composer_featured_thumbnail( $width = 'full', $height = 'full', $only_src = true, $show_placeholder = true, $lazy_load = true ) {

		$output = $image_thumb_url = $img_url = $alt = '';

		if( has_post_thumbnail() ){

			$image_id = get_post_thumbnail_id();

			$image_thumb_url = wp_get_attachment_image_src( $image_id, 'full' );
		}

		if( is_float( $width ) ) {
			$width = (int) round($width);
		}
		if( is_float( $height ) ) {
			$height = (int) round($height);
		}

		if( ! is_int( $width ) ) {
			$width = (int) $width;
		} 

		if( !is_int( $height ) ) {
			$height = (int) $height;
		}

		if( ! empty( $image_thumb_url ) ) {

			$img = aq_resize( $image_thumb_url[0], $width , $height, true, true );

			// if that image not met the mentioned width/height loads full size image url
			$img_url = ( $img ) ? $img : $image_thumb_url[0];

			$alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );

		}
		else if( empty( $image_thumb_url ) && $show_placeholder ) {

			$protocol = is_ssl() ? 'https' : 'http';

			$default_placeholder = composer_get_option_value( 'placeholder', '' );

			$img_url = empty( $default_placeholder ) ? $protocol.'://placehold.it/'.$width.'x'.$height : $default_placeholder;	

			$alt = esc_attr__( 'Placeholder', 'composer' );
		}

		if( ! empty( $img_url ) ) {
			if( $only_src ) {
				$output = $img_url;
			}
			else {
				$output = '<img src="'.esc_url( $img_url ) .'" alt="'. esc_attr( $alt ) .'">';
			}
		}

		return $output;

	}
}

/**
 * [composer_get_image Print html fragments of image]
 * @param  array $args
 * @version 1.1
 * @return string
 */

if( ! function_exists( 'composer_get_image' ) ) {

	/*
		It allows:

		$args = array(
			'image_id'    => '', // If its not set load post thumbnail
			'image_tag'   => true,
			'placeholder' => true,
			'before'      => '<div>',
			'after'       => '</div>',
			'width'       => $width,
			'height'      => $height,
			'srcset'      => array(
				'1024' => array( $width, $height )
			)
		);
	*/

	function composer_get_image( $args ) {

		// Empty assignment
		$output = $srcset_html = $alt = '';

		$image_id = isset( $args['image_id'] ) && ! empty( $args['image_id'] ) ? $args['image_id'] : get_post_thumbnail_id(); // Image ID

		$full_url = wp_get_attachment_image_src( $image_id, 'full' );
		$full_url = ! empty( $full_url ) ? $full_url[0] : ''; // Full image url

		$width = isset( $args['width'] ) ? $args['width'] : '';
		$height = isset( $args['height'] ) ? $args['height'] : '';

		if( ! empty( $full_url ) ) {

			$alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true ); // Alternative text

			// If width or height not set as 'full', crop the image
			$image_src = ( 'full' != $width && 'full' != $height && NULL != $height ) ? aq_resize( $full_url, $width , $height, true, true ) : $full_url;
			$image_src = ( $image_src ) ? $image_src : $full_url; // if the image size not met the crop size load full size image

			// Build src set
			$srcset_args = isset( $args['srcset'] ) ? $args['srcset'] : '';

			if( ! empty( $srcset_args ) ) {

				$srcset = array();

				foreach( $srcset_args as $key => $size ) {
					
					$crop_image = aq_resize( $full_url, $size[0] , $size[1], true, true );
					if( $crop_image ) {
						$srcset[] = aq_resize( $full_url, $size[0] , $size[1], true, true ) .' '.$key.'w';
					}
					else {
						$srcset[] = $image_src .' '.$key.'w';
					}
					
				}

				$srcset_html = implode( ', ', $srcset ); // split the srcset image url array to build html string
			}

		}
		else if( empty( $full_url ) ) {

			$show_placeholder = isset( $args['placeholder'] ) ? $args['placeholder'] : true;

			if( $show_placeholder ) {

				$alt = esc_attr__( 'Placeholder', 'composer' ); // Alternative text for placeholder image

				$protocol = is_ssl() ? 'https' : 'http';

				$default_placeholder = composer_get_option_value( 'placeholder', '' );

				// If none of the placeholder image set it in theme options load external image from placehold.it
				$image_src = empty( $default_placeholder ) ? $protocol.'://placehold.it/'.$width.'x'.$height : $default_placeholder;

			}
			
		}

		if( ! empty( $image_src ) ) {

			$image_tag = isset( $args['image_tag'] ) ? $args['image_tag'] : true;

			if( ! $image_tag ) {
				$output = $full_url;
			}
			else {
				$before = isset( $args['before'] ) ? $args['before'] : ''; // Before image tag
				$after = isset( $args['after'] ) ? $args['after'] : ''; // After image tag

				$output = $before . '<img src="'.esc_url( $image_src ) .'" srcset="'. esc_attr( $srcset_html ) .'" alt="'. esc_attr( $alt ) .'">' . $after;
			}
		}

		return $output;

	}
}

/*
 * Function : Get Metabox value
 * Version  : 1.1
 * Required : SMOF Theme Option
 * Desc  : It's only for get values from metabox
 */
if(!function_exists('composer_get_meta_value')){

	function composer_get_meta_value( $id, $meta_key, $meta_default = '', $themeoption_key = '', $themeoption_default = '' ) {

		$value = ( null != get_post_meta( $id, $meta_key, true ) ) ? get_post_meta( $id, $meta_key, true ) : $meta_default;

		if( ( 'default' == $value || '' == $value ) && !empty( $themeoption_key ) ) {
			$value = composer_get_option_value( $themeoption_key, $themeoption_default );
		}

		return $value;
	}
}



function composer_title_tag( $title_tag ){
	$title_tag_array = array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'p' );

	if( in_array( $title_tag, $title_tag_array ) ) {
		return $title_tag;
	}
	else {
		return 'h2';
	}
}

//composer_shorten_text
function composer_shorten_text($text , $no_of__limit)
{
	$chars_limit = $no_of__limit;
	$chars_text = strlen($text);
	$text = $text." ";
	$text = substr($text,0,$chars_limit);
	$text = substr($text,0,strrpos($text,' '));
	if ($chars_text > $chars_limit)
	{

		$text = $text."...";

	}
	return $text;
}

/*
 * Function : Get Image Src from Media Object
 * Version  : 1.0
 * Required : Aqua Resize
 * Desc  : It's only for get image from metabox
 */

if( ! function_exists( 'composer_get_image_by_id' ) ) {

	function composer_get_image_by_id( $width, $height, $image_id = '', $only_src = true, $placeholder = false, $lazy_load = true ) {

		if( empty( $image_id ) ) {
			return;
		}

		// Empty assignment
		$output = $image_thumb_url = '';

		// Full image URL
		$image_thumb_url = wp_get_attachment_image_src( $image_id, 'full' );

		if( is_float( $width ) ) {
			$width = (int) round($width);
		}
		if( is_float( $height ) ) {
			$height = (int) round($height);
		}
		
		if( ! is_int( $width ) ) {
			$width = (int) $width;
		} 

		if( !is_int( $height ) ) {
			$height = (int) $height;
		}

		if( ! empty( $image_thumb_url ) ) {

			$img = aq_resize( $image_thumb_url[0], $width , $height, true, true );

			// if that image not met the mentioned width/height loads full size image url
			$img_url = ( $img ) ? $img : $image_thumb_url[0];

			$alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );

		}
		else if( empty( $image_thumb_url ) && $placeholder ) {

			$protocol = is_ssl() ? 'https' : 'http';

			$default_placeholder = composer_get_option_value( 'placeholder', '' );

			$img_url = empty( $default_placeholder ) ? $protocol.'://placehold.it/'.$width.'x'.$height : $default_placeholder;   

			$alt = esc_attr__( 'Placeholder', 'composer' );

		}

		if( $only_src ) {
			$output = $img_url;
		}
		else {
			$output = '<img src="'.esc_url( $img_url ) .'" alt="'. esc_attr( $alt ) .'">';
		}

		return $output;

	}
}


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

//Get saved dynamic css value
if( ! function_exists('composer_dynamic_css_option') ) {

	function composer_dynamic_css_option( $key, $default ) {

		$data = $GLOBALS["amz_option_data"];

		return isset( $data[$key] ) ? $data[$key] : $default;

	}

}

//Get saved themeoption array value
if(!function_exists('composer_get_option_array_value')){

	function composer_get_option_array_value($key1, $key2, $default) {

		global $smof_data;

		$value = isset($smof_data[$key1][$key2]) ? $smof_data[$key1][$key2] : $default;

		return $value;
	}
}

// Get saved themeoption array value
if( ! function_exists( 'composer_get_prefix' ) ) {

	function composer_get_prefix() {

		if ( composer_is_shop() ) {
			$prefix = 'shop_';
		}
		else if ( composer_is_single_shop() ) {
			$prefix = 'single_shop_';
		}
		else if ( is_singular('pix_portfolio') ) {
			$prefix = 'single_portfolio_';
		}
		else if( is_singular( 'page' ) ) {
			$prefix = 'page_';
		}		
		else if ( is_singular( 'post' ) || is_singular() ) {
			$prefix = 'single_';
		}
		else if( is_home() || is_front_page() ) {
			$prefix = 'blog_';
		}
		else if ( is_archive() ) {
			$prefix = 'archives_';
		}
		else if ( is_search() ) {
			$prefix = 'search_';
		}
		else if ( is_404() ) {
			$prefix = '404_';
		}
		else {
			$prefix = 'page_';
		}

		return $prefix;
	}
}

if( !function_exists( 'composer_pagination' ) ) {

	// Return pagination style
	function composer_pagination( $args = array(), $values = array() ) {

		//Empty assignment
		$output = '';

		// Set max number of pages
		if( !isset( $values['max'] ) ) {
			if( $args == '' ) {
				global $wp_query;
				$max = $wp_query->max_num_pages;
				if ( $max <= 1 )
					return;

			}
			else {
				// Assign and call query
				if( isset( $_GET['s'] ) && $_GET['s'] != '' ) {
					$args['s'] = $_GET['s'];
				}

				$q = new WP_Query( $args );
				$max = $q->max_num_pages;
				wp_reset_postdata();
				if ( $max <= 1 )
					return;

			}

			$values['max']   = $max;
		}

		// Set page number
		if( !isset( $values['paged'] ) ) {
			if( get_query_var( 'paged' ) ) {
				$paged = get_query_var( 'paged' );
			}
			elseif( get_query_var( 'page' ) ) {
				$paged = get_query_var( 'page' );
			}
			else {
				$paged = 1;
			}

			$values['paged']   = $paged;
		}

		// Hide pagination if no more posts exists
		if( 'load_more' == $values['style'] || 'autoload' == $values['style'] ) {
			if( $values['paged'] == $values['max'] ) return;

			if( is_home() || is_archive() || is_search() || is_404() ) {
				$page_id = get_option('page_for_posts');
			}
			else if ( composer_is_shop() ) {
				$page_id = wc_get_page_id( 'shop' );
			}
			else {
				global $wp_query; 
				$page_id = $wp_query->post->ID;
			}

			$current_url = get_permalink( $page_id );

		}

		// Add max number of pages to the values array
		$values['prefix'] = composer_get_prefix();

		if( 'load_more' == $values['style'] ) {

			$output .= "<div id='load-more-btn' class='load-more-btn'>
				<a href='#' data-link='". esc_url( $current_url ) ."' data-change-url='". esc_attr( $values['change_url'] ) ."' data-paged='". esc_attr( $values['paged'] ) ."' data-args='". json_encode( $args ) ."' data-values='". json_encode( $values ) ."'>". esc_html( $values['loadmore_text'] ) ."</a>
				<span class='hide loaded-msg'>". esc_html( $values['allpost_loaded_text'] ) ."</span>
				<div class='spinner' style='display: none;'>
					<div class='spinner-inner'>
						<div class='double-bounce1'></div>
						<div class='double-bounce2'></div>
					</div>
				</div>
			</div>";

		}
		elseif( 'autoload' == $values['style'] ) {
			$output .= "<div id='load-more-btn' class='load-more-btn amz-autoload'>
				<a href='#' data-link='". esc_url( $current_url ) ."' data-paged='". esc_attr( $values['paged'] ) ."' data-args='". json_encode( $args ) ."' data-values='". json_encode( $values ) ."'>". esc_html( $values['loadmore_text'] ) ."</a>
				<span class='hide loaded-msg'>". esc_html( $values['allpost_loaded_text'] ) ."</span>
				<div class='spinner' style='display: none;'>
					<div class='spinner-inner'>
						<div class='double-bounce1'></div>
						<div class='double-bounce2'></div>
					</div>
				</div>
			</div>";
		}
		elseif( 'number' == $values['style']  ) {

			$pagination = paginate_links( array(
				'base'         => esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) ),
				'format'       => '',
				'current'      => max( 1, $values['paged'] ),
				'total'        => $values['max'],
				'prev_text'    => '&larr;',
				'next_text'    => '&rarr;',
				'type'         => 'list',
				'end_size'     => 3,
				'mid_size'     => 3
			) );

			$output .= '<nav class="pagination clearfix">';
				$output .= $pagination;
			$output .= '</nav>';

		}
		elseif( 'text' == $values['style']  ) {
			if( get_next_posts_link() || get_previous_posts_link() ) {
				$output .= '<nav class="wp-prev-next ">
					<ul class="clearfix">';
					if( get_next_posts_link() ) {
						$output .= '<li class="prev-link">'.get_next_posts_link( __( '&laquo; Older Entries', 'composer' )).'</li>';
					}
					if( get_previous_posts_link() ) {
						$output .= '<li class="next-link">'.get_previous_posts_link( __( 'Newer Entries &raquo;', 'composer' )).'</li>';
					}
					$output .= '</ul>
				</nav>';
			}
		}

		return $output;
	}
}

function composer_bbp_is_user_home() {
	if ( function_exists('is_bbpress') ){
		return bbp_is_user_home();
	} else {
		return false;
	}
}


function composer_is_shop () {
	if ( function_exists('is_shop') ){
		return is_shop();
	} else {
		return false;
	}
}

function composer_is_single_shop () {
	if ( function_exists('is_product') ){
		return is_product();
	} else {
		return false;
	}
}

function composer_is_product_category () {
	if ( function_exists('is_product_category') ){
		return is_product_category();
	} else {
		return false;
	}
}

function composer_is_product_tag () {
	if ( function_exists('is_product_tag') ){
		return is_product_tag();
	} else {
		return false;
	}
}

function composer_is_product() {
	if ( function_exists('is_product') ){
		return is_product();
	} else {
		return false;
	}
}

/* returns class if vc_row exsist in content or vc disabled */
function composer_check_vc_active() {
	global $post;

	if( ! defined('WPB_VC_VERSION') || ( $post && ! preg_match( '/vc_row/', $post->post_content ) ) ) {
		return ' container no-vc-active';
	} else {
		return '';
	}

}

function composer_get_registered_sidebars( $hide_sidebars = array() ) {
	global $wp_registered_sidebars;
	
	$sidebars = $wp_registered_sidebars;
	$new_sidebars = array( '0' => esc_attr__( 'Default', 'composer' ) );

	//foreach ($value['options'] as $select_ID => $option) {
	foreach ( $sidebars as $sidebar ) {

		if ( ! in_array( $sidebar['id'], $hide_sidebars ) ) {
			$new_sidebars[$sidebar['id']] = $sidebar['name'];
		}
		
	}

	return $new_sidebars;
}

function composer_get_the_term_list( $id, $taxonomy, $before = '', $sep = '', $after = '' ) {
	$terms = get_the_terms( $id, $taxonomy );
 
	if ( is_wp_error( $terms ) )
		return $terms;
 
	if ( empty( $terms ) )
		return false;

	$skip_terms = composer_get_option_value( 'portfolio_skip_terms', array() );
 
	$links = array();
 
	foreach ( $terms as $term ) {
		$link = get_term_link( $term, $taxonomy );
		if ( is_wp_error( $link ) ) {
			return $link;
		}
		if( ! in_array( $term->slug, $skip_terms ) ) {
			$links[] = '<a href="' . esc_url( $link ) . '" rel="tag">' . $term->name . '</a>';
		}
	}
 
	/**
	 * Filters the term links for a given taxonomy.
	 *
	 * The dynamic portion of the filter name, `$taxonomy`, refers
	 * to the taxonomy slug.
	 *
	 * @since 2.5.0
	 *
	 * @param array $links An array of term links.
	 */
	$term_links = apply_filters( "term_links-{$taxonomy}", $links );
 
	return $before . join( $sep, $term_links ) . $after;
}

function composer_get_options_arrays_by_key( $id ) {

	global $of_options;

	$key = array_search( $id, array_column( $of_options, 'id' ) );
 
	return $of_options[$key];
}


