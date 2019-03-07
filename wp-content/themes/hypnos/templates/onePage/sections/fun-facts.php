<?php 
$query = ( $GLOBALS['ff-query']);
?>
<section class="section-fun-facts facts"<?php ff_print_section_id(); ?>>
	<div class="container">
		<?php
			$facts = $query->get('one-fact');
			foreach( $facts as $oneFact ) {
				echo '<div class="four columns">';
					echo '<div class="facts-wrap">';
						echo '<div class="facts-wrap-num"><span class="counter">'.$oneFact->get('number').'</span></div>';
						echo '<h6>'.$oneFact->get('description').'</h6>';
					echo '</div>';
				echo '</div>';
			}
		?>
	</div>
</section>	