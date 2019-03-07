<?php
$query = ( $GLOBALS['ff-query']);


$fwc = ffContainer::getInstance();

$preparing_posts = $fwc
	->getPostLayer()
	->getPostGetter()
	->setNumberOfPosts(-1)
	->setFilterRelation_OR()
	;
$taxonomies = explode( '--||--', $query->get('taxonomies-ff') );
foreach ($taxonomies as $tax) {
	$preparing_posts->filterByTaxonomy( $tax, 'ff-portfolio-category' );
}

$posts = $preparing_posts->getPostsByType('portfolio');

$postMeta = $fwc->getDataStorageFactory()->createDataStorageWPPostMetas();

$work_html = '';

$portfolio_tags = array();

if( empty( $posts )  ) {
	$posts = array();
}


$portfolio_filter_by = $query->get('filter_portfolio_by');
if( empty( $portfolio_filter_by ) or ( 'category' != $portfolio_filter_by ) ){
	$portfolio_filter_by = 'tag';
}


foreach( $posts as $onePost ) {

	$data = $postMeta->getOption( $onePost->getID(), 'portfolio_options');
	$postQuery = $fwc->getOptionsFactory()->createQuery( $data,'ffComponent_Theme_MetaboxPortfolio');


	$tagClasses = array();
	$t = wp_get_post_terms( $onePost->getID(), 'ff-portfolio-' . $portfolio_filter_by );
	if( !empty($t) ) foreach ($t as $onePortfolioTag) {
		$tagClasses[] = $portfolio_filter_by.'-'.$onePortfolioTag->slug;
		$portfolio_tags[ $portfolio_filter_by.'-'.$onePortfolioTag->slug ] = $onePortfolioTag;
	}

	$work_html .= '<li class="portfolio-box '.implode( ' ', $tagClasses).'">';
	$work_html .= '<a class="expander" href="'.$onePost->getID().'" title="">';
	$work_html .= '<img  src="'.esc_url( $postQuery->getImage('small image')->url ).'" alt="" />';
	$work_html .= '<figure class="effect-sadie">';
	$work_html .= '<figcaption>';
	$work_html .= '<h5>'.ff_wp_kses( $postQuery->get('small title') ).'</h5>';
	$work_html .= '<p>'.ff_wp_kses( $postQuery->get('small description') ).'</p>';
	$work_html .= '</figcaption>';
	$work_html .= '</figure>';
	$work_html .= '</a>';
	$work_html .= '</li>';
}

?>

<!-- PORTFOLIO SECTION
    ================================================== -->

<section class="section-portfolio work"<?php ff_print_section_id(); ?>>

	<div class="container">
		<div class="sixteen columns">
			<h1><?php echo ff_wp_kses( $query->get('title') ); ?></h1>
		</div>
		<div class="sixteen columns">
			<div class="sub-text-line"></div>
		</div>
		<div class="sixteen columns">
			<div class="sub-text link-svgline"><?php echo $query->get('description'); ?></div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="clear"></div>

	<div class="portfolio"></div>


	<div class="expander-wrap relative">
		<div id="expander-wrap">
			<p class="cls-btn"><a class="close">X</a></p>
			<div class="expander-inner"></div>
		</div>
	</div>

	<div class="clear"></div>

	<div class="container">
		<div class="sixteen columns">
			<div id="portfolio-filter">
				<ul id="filter">
					<li><div class="link-svgline"><a href="#" class="current" data-filter="*" title=""><?php
						echo $query->get('show_all');
					?><svg class="link-svgline"><use xlink:href="#svg_line"></use></svg></a></div></li>
					<?php
						foreach( $portfolio_tags as $slug => $name ) {
							echo '<li>';
								echo '<div class="link-svgline">';
									echo '<a href="#" data-filter=".'.$slug.'" class="ff-filter-'.$slug.'" title="">'.$name->name.'<svg class="link-svgline"><use xlink:href="#svg_line"></use></svg></a>';
								echo '</div>';
							echo '</li>';
						}
					?>
				</ul>
			</div>
		</div>
	</div>

	<div class="clear"></div>

	<ul class="portfolio-wrap">
	<?php

		// Generated HTML output
		echo $work_html;

	?>
	</ul>

	<div class="clear"></div>

</section>