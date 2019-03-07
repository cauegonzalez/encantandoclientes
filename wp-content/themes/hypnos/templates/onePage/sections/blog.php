<?php
$query = ( $GLOBALS['ff-query']);

$fwc = ffContainer::getInstance();

$taxonomiesMultiple = $query->getMultipleSelect('taxonomies');
$taxonomies = $query->get('taxonomies');

//var_dump( $taxonomies );

//var_dump( empty( $query->get('taxonomies') ));

//die();

$postGetter = $fwc->getPostLayer()->getPostGetter();

if( !empty( $taxonomies ) ) {
    $postGetter->filterByCategory( $taxonomiesMultiple );
}


$postGetter->setNumberOfPosts( $query->get('post-count') );
$posts = $postGetter->getPostsByType('post');


?>
<section class="section-blog parallax-section"<?php ff_print_section_id(); ?>>
	<div class="clear"></div>
	<div
		class="parallax-1"
		style="background-image:url('<?php echo esc_url( $query->getImage('background-image')->url); ?>')"
		data-parallax-speed="<?php echo esc_attr( $query->get('parallax_speed') ); ?>"
	></div>
	<div class="just_pattern_parallax"></div>

	<div class="blog">
		<div class="container z-index-pages">
			<div class="sixteen columns">
				<h4><?php echo ff_wp_kses( $query->get('title') ); ?></h4>
			</div>
			<div class="clear"></div>

			<?php if( $posts ) foreach( $posts as $onePost ) { ?>

			<div class="eight columns" data-scroll-reveal="enter left move 300px over 1s after 0.1s">
				<a href="<?php echo get_permalink( $onePost->getID() ); ?>">
					<div class="post-wrap">
						<div class="icon-blog"><?php
						switch ( get_post_format( $onePost->getID() ) ) {
							case 'aside':   echo '<i class="ff-font-awesome4 icon-doc-text"></i>'; break;
							case 'chat':    echo '<i class="ff-font-awesome4 icon-chat"></i>'; break;
							case 'gallery': echo '<i class="ff-font-awesome4 icon-camera"></i>'; break;
							case 'link':    echo '<i class="ff-font-awesome4 icon-link"></i>'; break;
							case 'image':   echo '<i class="ff-font-awesome4 icon-image"></i>'; break;
							case 'quote':   echo '<i class="ff-font-awesome4 icon-quote-right"></i>'; break;
							case 'status':  echo '<i class="ff-font-awesome4 icon-comment-empty"></i>'; break;
							case 'video':   echo '<i class="ff-font-awesome4 icon-video-camera"></i>'; break;
							case 'audio':   echo '<i class="ff-font-awesome4 icon-volume-up"></i>'; break;
							default:        echo '<i class="ff-font-awesome4 icon-pencil"></i>'; break;
						}
						?></div>
						<h6><?php echo ff_wp_kses( $onePost->getTitle() ); ?></h6>
					</div>
				</a>
			</div>

			<?php } ?>

			<div class="clear"></div>
			<div class="sixteen columns" data-scroll-reveal="enter bottom move 300px over 1s after 0.6s">
				<a href="<?php echo esc_url( $query->get('read-more-link') ); ?>">
					<div class="post-wrap">
						<div class="icon-blog"><i class="ff-font-awesome4 icon-plus"></i></div>
						<h6><?php echo ff_wp_kses( $query->get('read-more') ); ?></h6>
					</div>
				</a>
			</div>
			<div class="clear"></div>
		</div>
	</div>

	<div class="clear"></div>

</section>
<?php






