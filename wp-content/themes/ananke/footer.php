<?php
/**
 * The template for displaying the footer
 */
 global $theme_option; 
?>

<div id="footer">
	<a class="scroll" href="#home"><div class="back-top">&#xf102;</div></a>	
	<div class="container">
		<div class="twelve columns">
			<?php echo htmlspecialchars_decode($theme_option['footer_text']); ?>
		</div>
	</div>	
</div>
<?php wp_footer(); ?>
</body>
</html>