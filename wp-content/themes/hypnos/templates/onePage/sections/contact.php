<?php
$query = ( $GLOBALS['ff-query']);
?>


<!-- CONTACT SECTION
================================================== -->

<section class="section-contact contact"<?php ff_print_section_id(); ?>>

	<div class="container">
		<div class="sixteen columns">
			<h1><?php echo ff_wp_kses( $query->get('center-title') ); ?></h1>
		</div>
		<div class="sixteen columns">
			<div class="sub-text-line"></div>
		</div>
		<div class="sixteen columns">
			<div class="sub-text link-svgline"><?php echo ff_wp_kses( $query->get('center-description')); ?></div>
		</div>
		<div class="clear"></div>
		<div class="sixteen columns">
			<h4><?php echo ff_wp_kses( $query->get('form-title') ); ?></h4>
		</div>
		<div class="clear"></div>
		<form name="ajax-form" id="ajax-form" action="<?php echo get_site_url(); ?>/?mail-it=1" method="post">
			<div class="eight columns">
				<label for="name">
					<span class="error" id="err-name"><?php echo ff_wp_kses( $query->get('err-name' ) ); ?></span>
				</label>
				<input name="name" id="name" type="text" placeholder="<?php echo esc_attr( $query->get('form-name') ); ?>"/>
			</div>
			<div class="eight columns">
				<label for="email">
					<span class="error" id="err-email"><?php echo ff_wp_kses( $query->get('err-email') ); ?></span>
					<span class="error" id="err-emailvld"><?php echo ff_wp_kses( $query->get('err-emailvld') ); ?></span>
				</label>
				<input name="email" id="email" type="text" placeholder="<?php echo esc_attr( $query->get('form-email') ); ?>"/>
			</div>
			<div class="sixteen columns">
				<label for="message"></label>
				<textarea name="message" id="message" placeholder="<?php echo esc_attr( $query->get('form-content') ); ?>"></textarea>
			</div>
			<div class="sixteen columns">
				<div id="button-con"><button class="send_message" id="send"><span data-hover="<?php echo esc_attr( $query->get('form-send') ); ?>"><?php echo ff_wp_kses( $query->get('form-send') ); ?></span></button></div>
			</div>
			<div class="clear"></div>
			<div class="error text-align-center" id="err-form"><?php echo ff_wp_kses( $query->get('err-form') ); ?></div>
			<div class="error text-align-center" id="err-timedout"><?php echo ff_wp_kses( $query->get('err-timedout') ); ?></div>
			<div class="error" id="err-state"></div>
			<?php
				$data = array();
				$data['email'] = $query->get('msg_email');
				$data['subject'] = $query->get('msg_subject');

				$data = json_encode( $data );

				echo '<div class="ff-contact-info" style="display:none;">'.ffContainer::getInstance()->getCiphers()->freshfaceCipher_encode( $data ).'</div>';
			?>
		</form>
		<div class="clear"></div>
		<div id="ajaxsuccess"><?php echo ff_wp_kses( $query->get('ajaxsuccess') ); ?></div>
		<div class="ff-contact-ajax-error" style="display:none;"><?php echo ff_wp_kses( $query->get('err-email-sending')); ?></div>
	</div>

	<div class="clear"></div>

</section>
