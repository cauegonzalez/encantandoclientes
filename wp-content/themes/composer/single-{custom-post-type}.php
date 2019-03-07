<?php
/**
 * The template for custom post types
 *
 * @package Composer
 */

get_header();

$composer_id = get_the_ID(); 

$composer_page_layout = composer_get_meta_value( $composer_id, '_amz_layout', 'default' );

//Sidebar
$composer_selected_sidebar = composer_get_meta_value( $composer_id, '_amz_sidebar', '0' );

$class = composer_check_vc_active();

if( empty( $class ) ) {
    if ( $composer_page_layout == 'right-sidebar' || $composer_page_layout == 'left-sidebar' || $composer_page_layout == 'right-nav' || $composer_page_layout == 'left-nav' ) {
        $class = ' container';
    }
}

if( post_password_required() ) {
    $class .= ' container no-vc-active';
}

?>

    <div id="primary" class="content-area">
        
        <main id="main" class="site-main<?php echo esc_attr( $class ); ?>">

                <?php 
                    if ( $composer_page_layout == 'right-sidebar' || $composer_page_layout == 'left-sidebar' || $composer_page_layout == 'right-nav' || $composer_page_layout == 'left-nav' ) {
                        echo '<div class="row padding-top">';

                        echo '<div class="col-md-9 col2-layout">';
                    }
                ?>

                <?php while ( have_posts() ) : the_post(); ?>

                    <?php the_content(); ?>

                    <?php
                        //Show/Hide comment section
                        comments_template();
                    ?>

                <?php endwhile; // End of the loop. ?>


                <?php 
                    if ( $composer_page_layout == 'right-sidebar' || $composer_page_layout == 'left-sidebar' || $composer_page_layout == 'right-nav' || $composer_page_layout == 'left-nav' ) {

                        echo '</div>'; //col-md-9

                        //If the sidebar position is right or left sidebar, it ll apply
                        if( 'full-width' != $composer_page_layout || 'default' != $composer_page_layout ){

                            if ( $composer_page_layout == 'right-sidebar' || $composer_page_layout == 'left-sidebar' ) {

                                composer_sidebar( $composer_selected_sidebar , 'primary-sidebar' );

                            //If the Side Menu Position is right or left, it ll apply
                            } elseif( $composer_page_layout == 'right-nav' || $composer_page_layout == 'left-nav' ) {
                                echo '<div id="aside" class="sidebar col-md-3">';
                                    if($composer_page_layout == 'left-nav' ){
                                        composer_side_nav( $composer_page_layout, 'left');
                                    } elseif($composer_page_layout == 'right-nav' ) {
                                        composer_side_nav($composer_page_layout, 'right');                                  
                                    }
                                echo '</div>';
                            }
                        }

                        echo '</div>'; //row
                    }
                ?>

        </main><!-- #main -->
    </div><!-- #primary -->
    
<?php get_footer(); ?>
