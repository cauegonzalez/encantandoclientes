<?php

class ffThemeAssetsIncluder extends ffThemeAssetsIncluderAbstract {


	public function isAdmin() {
		ffContainer::getInstance()->getWPLayer()->wp_add_inline_style('edit_layers', $this->_revSliderFixCode() );
	}

	private function _includeGoogleFont( $font_name ){
		if( FALSE !== strpos($font_name, ',') ){
			// THIS IS NOT GOOGLE FONT
			return;
		}

		$font_name = str_replace("'", "", $font_name);

		$fontIdValue = str_replace(' ', '-', $font_name );
		$fontIdValue = strtolower( $fontIdValue );

		$src = '//fonts.googleapis.com/css?family='.$font_name.':100italic,300italic,400italic,500italic,600italic,700italic,800italic,900italic,100,300,400,500,600,700,800,900&subset=latin,latin-ext';
		$this->_getStyleEnqueuer()->addStyle( 'google-font-' . esc_attr( $fontIdValue ), $src);
	}

	private function _includeCss() {
		$styleEnqueuer = $this->_getStyleEnqueuer();

		$styleEnqueuer->addStyleTheme('ff-base','/css/base.css');
		$styleEnqueuer->addStyleTheme('ff-skeleton','/css/skeleton.css');

		$colorsQuery = ffThemeOptions::getQuery('colors');
		$skin = $colorsQuery->get('skin');
		$styleEnqueuer->addStyleTheme('ff-layout','/css/layout-'.$skin.'.css');

		$styleEnqueuer->addStyleTheme('ff-owl-carousel','/css/owl.carousel.css');
		$styleEnqueuer->addStyleFramework( 'ff-font-awesome4', '/framework/extern/iconfonts/ff-font-awesome4/ff-font-awesome4.css' );
		// $styleEnqueuer->addStyleTheme('ff-retina','/css/retina.css');

		$accent = $colorsQuery->get('accent');
		$styleEnqueuer->addStyleTheme('ff-color-accent','/css/colors/color-'.$accent.'.css');

		$fontQuery = ffThemeOptions::getQuery('font');

		$this->_includeGoogleFont( $fontQuery->get('headers') );
		$this->_includeGoogleFont( $fontQuery->get('body') );
		$this->_includeGoogleFont( $fontQuery->get('buttons') );
		$this->_includeGoogleFont( $fontQuery->get('pre') );

        $headers_font = esc_url( $fontQuery->get('headers') );

        if( 1 * $fontQuery->get('default_headers') ){
            $headers_font = $fontQuery->get('theme-header');
        }

        $headers_font_css = ".button-map,
.facts-wrap-num,
.big-text,
h1, h2, h3, h4, h5, h6,
blockquote,
.post.format-link > p:first-child {
    font-family: ".$headers_font.", sans-serif;
}
";
        if( 1 * $fontQuery->get('default_headers') ){
            $headers_font_css .=
                "@font-face {
                    font-family: '".$headers_font."';
                    src: url('".get_template_directory_uri()."/css/font/".$headers_font.".eot');
                    src: url('".get_template_directory_uri()."/css/font/".$headers_font.".eot?#iefix') format('embedded-opentype'),
                         url('".get_template_directory_uri()."/css/font/".$headers_font.".woff') format('woff'),
                         url('".get_template_directory_uri()."/css/font/".$headers_font.".ttf') format('truetype'),
                         url('".get_template_directory_uri()."/css/font/".$headers_font.".svg') format('svg');
                    font-weight: normal;
                    font-style: normal;
            }";
        }

		ffContainer::getInstance()->getWPLayer()->wp_add_inline_style('ff-layout', "
.post-sidebar button,
.post-sidebar input,
button.post-comment,
.leave-reply textarea,
.leave-reply input,
#sync1 .item h6 span,
#sync1 .item p,
.con-detal-wrapper p,
#button-con button,
#button-con,
textarea,
input,
.price-wrap .link-svgline a,
.price-wrap p,
.video-text p,
.tipper .tipper-content ,
#filter li a,
figure.effect-sadie h5 span,
.facts-wrap h6,
.slide-featured p,
.sub-text,
.cl-effect a,
.small-text,
ul.slimmenu li a,
body,
.logo,
#royal_preloader.text .loader,
#switch {
	font-family: ".$fontQuery->get('body').", sans-serif;
}
pre, code{
	font-family: ".$fontQuery->get('pre').", Courier, monospace;
}


.link-recents a,
.link-tag a,
.reply,
.post-content-com-top p,
.list-in-blog-content li,
.read-more span,
.read-more p{
	font-family: ".$fontQuery->get('buttons').", sans-serif;
}

.flex-pauseplay a:before  {
	font-family: 'flexslider-icon';
}

@font-face {
	font-family: 'flexslider-icon';
	src:url('".get_template_directory_uri()."/css/font/flexslider-icon.eot');
	src:url('".get_template_directory_uri()."/css/font/flexslider-icon.eot?#iefix') format('embedded-opentype'),
		url('".get_template_directory_uri()."/css/font/flexslider-icon.woff') format('woff'),
		url('".get_template_directory_uri()."/css/font/flexslider-icon.ttf') format('truetype'),
		url('".get_template_directory_uri()."/css/font/flexslider-icon.svg#flexslider-icon') format('svg');
	font-weight: normal;
	font-style: normal;
}

"
 . $headers_font_css
 . $this->_revSliderFixCode()
);


	}

	private function _includeJs() {
		$scriptEnqueuer = $this->_getScriptEnqueuer();

		$scriptEnqueuer->addScriptTheme('jquery');
		$scriptEnqueuer->getFrameworkScriptLoader()->requireFrsLib();
		$scriptEnqueuer->addScriptTheme('ff-modernizr','/js/modernizr.custom.js', null, null, true);

		if( ! ffThemeOptions::getQuery('layout disable-pageloader' ) ){
			$scriptEnqueuer->addScriptTheme('ff-royal-preloader','/js/royal_preloader.min.js', null, null, true);
		}

        if( ! ffThemeOptions::getQuery('layout disable-smoothscroll' ) ){
            $scriptEnqueuer->addScriptTheme('ff-scroll','/js/scroll.js', null, null, true);
        }

		$scriptEnqueuer->addScriptTheme('ff-pagescroll','/js/jquery.malihu.PageScroll2id.js', null, null, true);

		$scriptEnqueuer->addScriptTheme('ff-bxslider','/js/jquery.bxslider.min.js', array('jquery'), null, true);
		$scriptEnqueuer->addScriptTheme('ff-easing','/js/jquery.easing.js', null, null, true);
		$scriptEnqueuer->addScriptTheme('ff-scroll-reveal','/js/scrollReveal.js', null, null, true);
		$scriptEnqueuer->addScriptTheme('ff-navigation','/js/navigation.js', null, null, true);
		$scriptEnqueuer->addScriptTheme('ff-classie','/js/classie.js', null, null, true);
		$scriptEnqueuer->addScriptTheme('ff-header','/js/cbpAnimatedHeader.min.js', null, null, true);
		$scriptEnqueuer->addScriptTheme('ff-filmroll','/js/jquery.film_roll.js', null, null, true);
		$scriptEnqueuer->addScriptTheme('ff-counterup','/js/jquery.counterup.min.js', null, null, true);
		$scriptEnqueuer->addScriptTheme('ff-waypoints','/js/waypoints.min.js', null, null, true);
		$scriptEnqueuer->addScriptTheme('ff-html5shiv','/js/html5shiv.js', null, null, true);
		$scriptEnqueuer->addScriptTheme('ff-flip-carousel','/js/flip-carousel.js', null, null, true);
		$scriptEnqueuer->addScriptTheme('ff-parallax','/js/jquery.parallax-1.1.3.js', null, null, true);
		$scriptEnqueuer->addScriptTheme('ff-flexslider','/js/jquery.flexslider.min.js', null, null, true);
		$scriptEnqueuer->addScriptTheme('ff-carousel','/js/owl.carousel.min.js', null, null, true);
		$scriptEnqueuer->addScriptTheme('ff-isotope','/js/isotope.js', null, null, true);
		$scriptEnqueuer->addScriptTheme('ff-fitvids','/js/jquery.fitvids.js', null, null, true);
		$scriptEnqueuer->addScriptTheme('ff-tipper','/js/jquery.fs.tipper.min.js', null, null, true);
		$scriptEnqueuer->addScriptTheme('ff-contact','/js/contact.js', null, null, true);
        $scriptEnqueuer->addScriptTheme('ff-intense','/js/intense.min.js', null, null, true);
        $scriptEnqueuer->addScriptTheme('ff-template','/js/template.js', null, 7, true);
	}

	public function isNotAdmin() {
		$this->_includeCss();
		$this->_includeJs();
	}

	private function _revSliderFixCode(){
        $fontQuery = ffThemeOptions::getQuery('font');
        $headers_font = esc_url( $fontQuery->get('headers') );

        if( 1 * $fontQuery->get('default_headers') ){
            $headers_font = $fontQuery->get('theme-header');
        }

		return
"
.just_pattern {

    position: absolute;
    opacity: 0.5;
    left: 0px;
    top: 0px;
    right:0;
    bottom:0;
    width: 100%;
    height: 100%;
    z-index: 3;
}
.small-text {
    width:100%;
    font-family: 'Lato', sans-serif;
    font-weight:400;
    color:#fff;
    letter-spacing:2px;
    text-shadow: 0 0 5px rgba(0,0,0,0.3);
    text-transform:uppercase;
    text-align:center;
    font-size: 27px;
    line-height:27px;
    z-index: 200;
}
.big-text {
    width:100%;
    font-family: ".$headers_font.", sans-serif;
    color:#fff;
    letter-spacing:4px;
    text-transform:uppercase;
    text-align:center;
    font-size:75px;
    line-height:75px;
    z-index: 200;
}
.big-text span{
    font-size:70px;
    line-height:70px;
}

.cl-effect {
    width:100%;
    z-index:100;
    text-align:center;
}
.cl-effect a {
    display: inline-block;
    outline: none;
    text-decoration: none;
    font-family: 'Lato', sans-serif;
    text-transform: uppercase;
    letter-spacing: 1px;
    font-weight: 400;
    font-size: 12px;
    border:2px solid #ffffff;
    color: #ffffff;
    text-align:center;
    overflow:hidden;
    z-index:100;
}

.cl-effect a:hover,
.cl-effect a:focus {
    outline: none;
}

.cl-effect a {
    overflow: hidden;
    padding: 10px 45px;
    color: #ffffff;
}

.cl-effect a span {
    position: relative;
    display: inline-block;
    -webkit-transition: -webkit-transform 0.3s;
    -moz-transition: -moz-transform 0.3s;
    transition: transform 0.3s;
    color: #ffffff;
}

.cl-effect a span::before {
    position: absolute;
    margin-top:15px;
    top: 100%;
    content: attr(data-hover);
    font-weight: 400;
    -webkit-transform: translate3d(0,0,0);
    -moz-transform: translate3d(0,0,0);
    transform: translate3d(0,0,0);
}

.cl-effect a:hover span,
.cl-effect a:focus span {
    top:-15px;
    -webkit-transform: translateY(-100%);
    -moz-transform: translateY(-100%);
    transform: translateY(-100%);
}

.section-slider .just_pattern{
    top: 0 !important;
    left: 0 !important;
}

.section-slider div .tp-caption.small-text {
    font-family: 'Lato', sans-serif;
    font-weight: normal;
    line-height: 24px;
    letter-spacing: 1px;
    font-size: 24px;
}

.section-slider div .tp-caption.big-text{
    text-transform: uppercase;
    text-align: center;
    font-size: 75px;
    line-height: 75px;
}

.section-slider div .tp-caption.big-text span{
    width: 100%;
    font-family: ".$headers_font.", sans-serif;
    line-height: 75px;
    line-height: normal;
    font-size: inherit !important;
}
";

	}

}




