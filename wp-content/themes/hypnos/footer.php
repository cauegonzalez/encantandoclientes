	<!-- FOOTER
    ================================================== -->

	<div class="footer">
		<a href="#top" data-gal="m_PageScroll2id" ><div class="back-top"><i class="ff-font-awesome4 icon-angle-double-up"></i></div></a>
		<?php if( ffThemeOptions::getQuery('footer show-icons') or ffThemeOptions::getQuery('footer show-text') ){ ?>
		<div class="container">
			<?php if( ffThemeOptions::getQuery('footer show-icons') ){ ?>
			<div class="sixteen columns icons-footer">
				<?php foreach (ffThemeOptions::getQuery('footer footer-icons') as $key => $value) {
					echo '<a href="'.esc_url( $value->get('link') ).'" target="_blank"><i class="'.esc_attr( $value->get('icon') ).'"></i></a>';
				}
				?>
			</div>
			<?php } ?>
			<?php if( ffThemeOptions::getQuery('footer show-text') ){ ?>
			<div class="sixteen columns">
				<p><?php echo ffThemeOptions::getQuery('footer text'); ?></p>
			</div>
			<?php } ?>
		</div>
		<?php } ?>
	</div>
	<div class="clear"></div>

<?php if( ffThemeOptions::getQuery('layout page-layout-boxed' ) ){ ?>
	</div>
</div>
<?php } ?>


<?php wp_footer(); ?>
</body>

</html>