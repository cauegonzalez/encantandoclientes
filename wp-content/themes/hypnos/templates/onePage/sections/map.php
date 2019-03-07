<?php
$query = ( $GLOBALS['ff-query']);
?>

<section class="section-map"<?php ff_print_section_id(); ?>>

	<a class="button-map close-map">
		<span><?php echo ff_wp_kses( $query->get('section-title') ); ?></span>
		<i class="ff-font-awesome4 icon-chevron-down close-map-icon"></i>
		<i class="ff-font-awesome4 icon-chevron-up show-map-icon"></i>
	</a>
	<div id="google_map"></div>

	<div class="clear"></div>
</section>


<script type="text/javascript" src="//maps.google.com/maps/api/js?sensor=true<?php
$g_api_key = ffThemeOptions::getQuery('gapi key' );
if( !empty($g_api_key) ){
	echo '&amp;key='.esc_attr($g_api_key);
}
?>"></script>
<script type="text/javascript">
var e=new google.maps.LatLng(<?php echo floatval( $query->get('longitude') ); ?>,<?php echo floatval( $query->get('latitude') ); ?>),
	o={zoom:14,center:new google.maps.LatLng(<?php echo floatval( $query->get('longitude') ); ?>,<?php echo floatval( $query->get('latitude') ); ?>),
	mapTypeId:google.maps.MapTypeId.ROADMAP,
	mapTypeControl:!1,
	scrollwheel:!1,
	draggable:!0,
	navigationControl:!1
},

n=new google.maps.Map(document.getElementById("google_map"),o);
google.maps.event.addDomListener(window,"resize",function(){var e=n.getCenter();
google.maps.event.trigger(n,"resize"),n.setCenter(e)});

var g='<div class="map-tooltip"><h6><?php
	echo str_replace( "'", "\\'", ff_wp_kses( $query->get('marker-title') ) );
?></h6><p><?php
	echo str_replace( "'", "\\'", ff_wp_kses( $query->get('marker-description') ) );
?></p></div>',a=new google.maps.InfoWindow({content:g})
,t=new google.maps.MarkerImage("<?php echo get_template_directory_uri(); ?>/images/map-pin.png",new google.maps.Size(40,70),
new google.maps.Point(0,0),new google.maps.Point(20,55)),
i=new google.maps.LatLng(<?php echo floatval( $query->get('longitude') ); ?>,<?php echo floatval( $query->get('latitude') ); ?>),
p=new google.maps.Marker({position:i,map:n,icon:t,zIndex:3});
google.maps.event.addListener(p,"click",function(){a.open(n,p)});




</script>
<?php

