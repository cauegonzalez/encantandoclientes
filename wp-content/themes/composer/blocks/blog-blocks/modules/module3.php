<?php
    class module3 extends blog_blocks {
        public function build_module( $options = array() ) {

            if( !empty( $options ) ) {
                extract( $options );
            }

            // Empty assignment
            $output = '';

            // Set module name for variable
            $module = 'module3_';

            // Featured Image Width and Height
            $width = 70;
            $height = 70;

            // Feature Image ID
            $image_id = get_post_thumbnail_id();

            $output .= $this->open('module-3 clearfix');

                // Featured Image
                if( 'yes' == ${$module.'show_featured_image'} ) {
                    $output .= $this->open('post_img_70');
                        $output .= $this->get_image_by_id( $width, $height, $image_id, 0, 1 );
                    $output .= $this->close();
                }

                // Content
                $output .= $this->open('post_content');

                    // Top Meta
                    if( 'on_top' == ${$module.'show_meta'} ) {
                        $output .= $this->open( 'top-meta meta' );
                            $output .= $this->blog_meta( array( 'author' => 'yes', 'date' => 'yes' ), ${$module.'meta_prefix'}, ${$module.'show_meta'} ); // meta array, meta prefix, show/hide
                        $output .= $this->close(); // top-meta
                    }
                    
                    // Title
                    $output .= $this->title( 'title', $title_tag, ${$module.'title_length'} ); // class, title tag, title length

                    // Bottom Meta
                    if( 'on_bottom' == ${$module.'show_meta'} ) {
                        $output .= $this->open( 'bottom-meta meta' );
                            $output .= $this->blog_meta( array( 'author' => 'yes', 'date' => 'yes' ), ${$module.'meta_prefix'}, ${$module.'show_meta'} ); // meta array, meta prefix, show/hide
                        $output .= $this->close(); // bottom-meta
                    }

                $output .= $this->close();

            $output .= $this->close();

            return $output;
            
        }
    }