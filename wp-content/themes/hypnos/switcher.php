<!-- Switch Panel -->

<style type="text/css">
#switch {
	background: #fff;
	position: fixed;
	display: none;
	top: 126px;
	z-index: 99999;
	width:200px;
	margin-left: -100px;
	border-radius: 0 5px 5px 0;
	-webkit-box-shadow: 0px 0px 4px 0px rgba(51, 51, 51, 0.2);
	box-shadow: 0px 0px 4px 0px rgba(51, 51, 51, 0.2);}
#switch p {margin-bottom: 10px; padding-bottom: 15px; padding-top: 5px; border-bottom:#ededed 1px solid; }
#switch ul li {text-transform:uppercase;margin-bottom:0;font-size:12px; display:inline-block;}

#show {
    z-index: 99999;
    margin-left:0px;
    position:fixed;left:0;
    top:20%;
    background: rgba(40,40,40,.8);
    border-radius:0 3px 3px 0;
    margin-top:10px;
    padding: 25px 10px 20px 10px;
    cursor: pointer;
	color: #ffffff !important;
}

#show i 	{
	font-size: 17px;
	display: block;
	margin: 7px auto 0 auto;
	text-align: center;
	color: #ffffff !important;
}

#hide {cursor:pointer;line-height:13px;margin-bottom:0px;font-size: 12px;margin-bottom: 0px;}
#setting {
    height: 50px;
    background-image: url('<?php echo get_template_directory_uri(); ?>/images/option_panel.png');
    background-repeat:no-repeat;
    background-size:20px 50px;
    width: 20px;
}

.content-switcher{
padding: 16px;
overflow: hidden;
}
.content-switcher .m-btn{padding: 5px 10px;
font-size: 12px;
min-width: 70px;
}

.button.small.color.switch {font-size: 12px;text-transform: none;width: 40px;margin: 5px 0px; font-weight: normal;
text-shadow: 0px 1px 1px rgba(0, 0, 0, 0.3) !important; letter-spacing: 0;}

#hide {
    position:absolute;
    background-color:#fff;
    height:30px;
    width:30px;
    top:7px;
    right:7px;
    border-radius: 0 5px 0px 0;
}

#hide img {
    height:30px;
    width:30px;
    opacity:0.3;
    transition:all 0.3s ease 0s;
    -moz-transition:all 0.3s ease 0s;
    -webkit-transition:all 0.3s ease 0s;
    -o-transition:all 0.3s ease 0s;
}

#hide img:hover {
    opacity:0.7;
}


#switch .button {
    border-radius: 2px;
    cursor: pointer;
    display: inline-block;
    margin:3px;
    height: 15px;
    line-height: 15px;
    padding: 5px;
    width: 15px;
    color:#000;
    text-align: center;
}

#switch p {
    margin:5px 0;
    color:#666666;
}
<?php

foreach( array( 'axis' , 'Vollkorn-Bold' , 'Sifonn-Basic' ) as $headers_font ){
	echo "@font-face {
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
?>
</style>

<div id="switch">
	<div class="content-switcher">
		<p>Color Skin:</p>
		<ul class="header">
			<li><span data-name="skin"   data-val="light" data-default="1" class="button color switch" style="background-color:#EEE">&nbsp;</span></li>
			<li><span data-name="skin"   data-val="dark"  data-default="0" class="button color switch" style="background-color:#333">&nbsp;</span></li>
		</ul>

		<p>Color Accent:</p>
		<ul class="header">
			<li><span data-name="accent" data-val="orange" data-default="1" class="button color switch" style="background-color:#e67e22">&nbsp;</span></li>
			<li><span data-name="accent" data-val="green"  data-default="0" class="button color switch" style="background-color:#2ecc71">&nbsp;</span></li>
			<li><span data-name="accent" data-val="red"    data-default="0" class="button color switch" style="background-color:#e74c3c">&nbsp;</span></li>
			<li><span data-name="accent" data-val="blue"   data-default="0" class="button color switch" style="background-color:#3498db">&nbsp;</span></li>
			<li><span data-name="accent" data-val="yellow" data-default="0" class="button color switch" style="background-color:#f1c40f">&nbsp;</span></li>
		</ul>

		<p>Headers Font:</p>
		<ul class="header">
			<li><a data-name="font"   data-val="axis" data-default="1" class="button color switch" style="background-color:#EEE;font-family:axis">A</a></li>
			<li><a data-name="font"   data-val="Vollkorn-Bold" data-default="0" class="button color switch" style="background-color:#EEE;font-family:Vollkorn-Bold">A</a></li>
			<li><a data-name="font"   data-val="Sifonn-Basic" data-default="0" class="button color switch" style="background-color:#EEE;font-family:Sifonn-Basic">A</a></li>
		</ul>

		<div class="clear"></div>

		<div id="hide">
			<img src="<?php echo get_template_directory_uri(); ?>/images/close.png" alt="Open / Close" />
		</div>
	</div>
</div>

<div id="show" style="display: block;">
	<div id="setting"></div>
	<i class="ff-font-awesome4 icon-cog"></i>
</div>

<script type="text/javascript">
// Switcher CSS
jQuery(document).ready(function($) {

	"use strict";

	$("#hide, #show").click(function () {
		if ($("#show").is(":visible")) {

			$("#show").animate({
				"margin-left": "-300px"
			}, 300, function () {
				$(this).hide();
			});

			$("#switch").animate({
				"margin-left": "0px"
			}, 300).show();
		} else {
			$("#switch").animate({
				"margin-left": "-300px"
			}, 300, function () {
				$(this).hide();
			});
			$("#show").show().animate({
				"margin-left": "0"
			}, 300);
		}
	});


	function setCookie(c_name,value){
		document.cookie=c_name + "=" + escape(value) + ';  path=/';
	}

	function getCookie(c_name){
		var i,x,y,ARRcookies=document.cookie.split(";");
		for (i=0;i<ARRcookies.length;i++){
			x=ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));
			y=ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);
			x=x.replace(/^\s+|\s+$/g,"");
			if (x==c_name) {
				if( 'false' == y){
					return false;
				}
				return unescape(y);
			}
		}
		return false;
	}

	$('#switch .switch').click(function(){
		var _name_ = $(this).attr('data-name');
		var _val_  = $(this).attr('data-val');

		switch(_name_) {
			case 'skin':
				var new_location = '';
				if( -1 == location.href.indexOf('hypnos-dark/') ){
					location.replace( location.href.replace('hypnos-light/','hypnos-dark/') );
					return false;
				}
				if( -1 == location.href.indexOf('hypnos-light/') ){
					location.replace( location.href.replace('hypnos-dark/','hypnos-light/') );
					return false;
				}
				return false;
			case 'accent':
				setCookie( _name_ , _val_ );
				$('#ff-color-accent-css').attr('href','<?php echo get_template_directory_uri(); ?>/css/colors/color-'+_val_+'.css');
				return false;
			case 'font':
				setCookie( _name_ , _val_ );
				$('#custon_header_font').remove();
				$('body').append('<style id="custon_header_font">.button-map, .facts-wrap-num, .big-text, .section-slider div .tp-caption.big-text span, h1, h2, h3, h4, h5, h6, blockquote, .post.format-link > p:first-child { font-family: '+_val_+', sans-serif; }</style>');
				$(window).resize();
				return false;
			default:
				console.log('What?');
		}
	});

	/* INIT */

	if( -1 == location.href.indexOf('hypnos-dark/') ){
		$('#switch .switch[data-name=skin][data-val=light]').hide();
	}else{
		$('#switch .switch[data-name=skin][data-val=dark]').hide();
	}

	if( getCookie('accent') ){
		$('#switch .switch[data-name=accent][data-val='+getCookie('accent')+']').click();
	}

	if( getCookie('font') ){
		$('#switch .switch[data-name=font][data-val='+getCookie('font')+']').click();
	}

	$('head').append('<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/layout-light.css" media="aural" disabled="true" />');
	$('head').append('<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/layout-dark.css" media="aural" disabled="true" />');

	$('head').append('<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/css/colors/color-orange.css" media="aural" disabled="true" />');
	$('head').append('<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/css/colors/color-green.css" media="aural" disabled="true" />');
	$('head').append('<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/css/colors/color-red.css" media="aural" disabled="true" />');
	$('head').append('<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/css/colors/color-blue.css" media="aural" disabled="true" />');
	$('head').append('<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/css/colors/color-yellow.css" media="aural" disabled="true" />');

	if( -1 != location.href.indexOf('#change-font#') ){
		$('#switch .switch[data-name=font][data-val='+location.href.split('#')[2]+']').click();
	}

});
</script>

<!-- Switch Panel -->







