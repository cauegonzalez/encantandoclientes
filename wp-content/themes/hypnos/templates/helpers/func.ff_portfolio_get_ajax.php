<?php

if( !function_exists('ff_portfolio_get_ajax') ) {

    function ff_portfolio_get_ajax(  ffAjaxRequest $ajaxRequest ) {




        $fwc = ffContainer::getInstance();
        $postId = $ajaxRequest->data['portfolioPostId'];

        $post = $fwc->getPostLayer()->getPostGetter()->getPostByID($postId);
        //ffPostCollectionItem;
        $postMeta = $fwc->getDataStorageFactory()->createDataStorageWPPostMetas();

        $data = $postMeta->getOption( $postId, 'portfolio_options');
        $query = $fwc->getOptionsFactory()->createQuery( $data,'ffComponent_Theme_MetaboxPortfolio');

        $big = $query->get('big');
    ?>
    <div class="ajax-project-single-wrapper">

            <div class="clear"></div>

            <div class="container">
                <div class="sixteen columns">
                    <h2><?php echo ff_wp_kses( $big->get('big-title') ); ?></h2>
                </div>
            </div>

            <div class="clear"></div>

            <div class="ajax-project-top-text">

                <div class="container">
                    <div class="nine columns">
                        <h4><?php echo ff_wp_kses( $big->get('title') ); ?></h4>
                        <p class="general-subtext"><?php echo ff_wp_kses( $big->get('description') ); ?></p>
                    </div>
                    <div class="seven columns">
                        <div class="ajax-project-top-text">
                            <?php
                                foreach( $big->get('list') as $oneLine ) {
                            ?>
                                <p><span>&#x2022;</span><?php echo ff_wp_kses( $oneLine->get('text') ); ?></p>
                            <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>

            </div>

            <div class="clear"></div>

            <?php

                switch( $big->get('type') ) {
                    case 'slider' :
            ?>

            <div class="project-slider-wrapper">

                <div class="container">
                    <div class="sixteen columns">
                        <div class="project-wrap-slider">
                            <ul class="slider-project-ajax">
                                <?php foreach( $big->get('images') as $oneImage ) { ?>
                                <li class="slide">
                                    <img src="<?php echo esc_url( $oneImage->getImage('image')->url ); ?>" alt="" />
                                </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
            <?php
                        break;
                    case 'gallery':
            ?>


            <div class="project-slider-wrapper">

                <div class="container">
                    <?php
                        foreach( $big->get('images') as $key => $oneImage ) {
                        $class = 'eight';
                        if( $key == 0 ) {
                            $class = 'sixteen';
                        }
                    ?>
                            <div class="<?php echo esc_attr($class); ?> columns">
                                <img src="<?php echo esc_url( $oneImage->getImage('image')->url ); ?>" alt="" />
                            </div>
                    <?php
                        }
                    ?>
                </div>

            </div>
            <?php
                    break;
                case 'video':
            ?>

            <div class="project-slider-wrapper">

                <div class="container">
                    <div class="sixteen columns">
                        <div class="video-container">
                            <?php
                                $video = $big->get('video');

                                $video = str_replace('http://', '//', $video);
                                $video = str_replace('https://', '//', $video);

                                if( strpos( $video,  'vimeo') ) {
                                    $video = str_replace('http://vimeo.com/', '', $video);
                                    $video = str_replace('https://vimeo.com/', '', $video);
                                    $video = str_replace('vimeo.com/', '', $video);
                                    $video = 'player.vimeo.com/video/'.$video;
                                    $video = str_replace('//','/', $video);
                                    $video = str_replace('//','/', $video);

                                    $video = 'http://'.$video;
                                }

                                if( strpos( $video,  'youtube.com/watch?v=') ) {
                                    $video = explode( '=', $video );
                                    $video = '//www.youtube.com/embed/'.$video[1];
                                }

                            ?>

                            <iframe src="<?php echo esc_url( $video ); ?>" width="1200" height="574" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                        </div>
                    </div>
                </div>

            </div>
            <?php
                break;
            }
            ?>

            <div class="clear"></div>


        </div>

    <?php
    }
}
