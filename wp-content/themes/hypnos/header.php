<!DOCTYPE html>
<!--[if IE 8]><html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]>
<!--><html class="no-js" <?php language_attributes(); ?>><!--<![endif]-->
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<!-- Mobile Specific Metas
	================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<!-- CSS
	================================================== -->
	<script type="text/javascript">
		var ajaxurl = "<?php echo esc_url( admin_url('admin-ajax.php') ); ?>";
		var ff_template_url = "<?php echo esc_url( get_template_directory_uri() ); ?>";
	</script>
	<style type="text/css">body.royal_loader {background: none;visibility: hidden;}</style>
	<?php wp_head(); ?>
</head>
<body <?php
$body_classes = '';
if( ! ffThemeOptions::getQuery('layout disable-pageloader' ) ){
	$body_classes = 'royal_loader';
}
body_class($body_classes);
?> data-royal-loader-text="<?php echo esc_attr(ffThemeOptions::getQuery('layout pageloader-text')) ?>">

<?php if( ffThemeOptions::getQuery('layout page-layout-boxed' ) ){ ?>
<div id="main-wrapper-box" style="background-image:url('<?php
	$bck = json_decode( ffThemeOptions::getQuery('layout background-image' ) );
	if( !empty( $bck ) ){
		echo esc_url( $bck->url );
	}
	?>')">
	<div id="main-wrap-box">
<?php } ?>






