<?php 

/*
 * Testimonial Widget
*/
class Composer_Recent_Post_Widget extends WP_Widget {

	function __construct() {
		$widget_options = array('classname' => 'recentpost', 'description' => esc_html__('Display Recent Posts','composer' ));
		parent::__construct('composer_recent_post',esc_html__('Composer:: Recent Post','composer' ),$widget_options);
	}

	function widget( $args, $instance ) {
		$cache = wp_cache_get('widget_recent_posts', 'widget');

		if ( !is_array($cache) )
			$cache = array();

		if ( ! isset( $args['widget_id'] ) )
			$args['widget_id'] = $this->id;

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];
			return;
		}

		ob_start();
		extract( $args );

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : esc_html__( 'Recent Posts', 'composer' );
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
		$show_image = isset( $instance['show_image'] ) ?  $instance['show_image'] : false;
		$width = ( ! empty( $instance['width'] ) ) ? $instance['width'] : 70;
		$height = ( ! empty( $instance['height'] ) ) ? $instance['height'] : 70;
		$show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;
		$insert_type = ( ! empty( $instance['insert_type'] ) ) ? $instance['insert_type'] : 'posts';
		$order_by = ( ! empty( $instance['order_by'] ) ) ? $instance['order_by'] : 'modified';
		$order = ( ! empty( $instance['order'] ) ) ? $instance['order'] : 'desc';
		$id = ( ! empty( $instance['id'] ) ) ? $instance['id'] : '';
		$category = ( ! empty( $instance['category'] ) ) ? $instance['category'] : '';
		$exclude_id = ( ! empty( $instance['exclude_id'] ) ) ? $instance['exclude_id'] : '';
		$exclude_category = ( ! empty( $instance['exclude_category'] ) ) ? $instance['exclude_category'] : '';
		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
		
		
		// Build id and category as array
		$post_in = ! empty( $id ) ? array_filter( explode( ',', $id ) ) : array();
		$category = ! empty( $category ) ? array_filter( explode( ',', $category ) ) : array();

		// Build post__not_in and category__not_in as array
		$post_not_in = array_filter( explode( ",", $exclude_id ) );
		$post_not_in = array_merge( ( array )$id, $post_not_in );
		$category_not_in = array_filter( explode( ",", $exclude_category ) );

		$q = array(			
			'order'               => $order,
			'orderby'             => $order_by,
			'posts_per_page'      => $number,
			'post__not_in'        => $post_not_in,
			'ignore_sticky_posts' => 1,
			'post_status'         => 'publish'
		);

		// Query arguement for Insert type: Posts, Category, ID
		if( $insert_type == 'id' && !empty( $post_in ) ){
			$id_args = array(
				'post__in' => $post_in
			);

			$q = array_merge( $q, $id_args );
		}
		else if( $insert_type == 'category' && !empty( $category ) ) {
			$tax_query[] = array(
				'taxonomy' => 'category',
				'field'    => 'slug',
				'terms'    => $category
	        );
		}

		if( ! empty( $category_not_in ) ) {
        	$tax_query[] = array(
				'taxonomy' => 'category',
				'field'    => 'slug',
				'terms'    => $category_not_in,
				'operator' => 'NOT IN'
	        );
        }

		// Build taxonomy query for removing quote and link post format posts
		$tax_query[] = array(
			'taxonomy' => 'post_format',
			'field' => 'slug',
			'terms' => array( 'post-format-quote', 'post-format-link' ),
			'operator' => 'NOT IN'
		);

		// Combine taxonomy query with main query
		if( ! empty( $tax_query ) ) {
			$tax_query = array_merge( array( 'relation' => 'AND' ), $tax_query );
			$q = array_merge( $q, array( 'tax_query' => $tax_query ) );
		}
		
		$r = new WP_Query( $q );

		//Empty assignment
		$image = '';

		if ( $r->have_posts() ) :

			echo $before_widget;
				if ( $title ) echo $before_title . esc_html($title) . $after_title;
				echo '<ul>';
					while ( $r->have_posts() ) : $r->the_post();
			
						$image = composer_featured_thumbnail( (int)$width, (int)$height, 0, 0, 1 );
						
						echo '<li>';
							if ( $show_image && ! empty( $image ) ) {
								echo '<div class="postImg">';
									echo $image;
								echo '</div>';
							}
								
							echo '<div class="content ">';
								echo '<p><a href="'. esc_url( get_permalink() ) .'">'. esc_html( get_the_title() ) .'</a></p>';
								if ( $show_date ) {
									echo '<span class="meta">'. esc_html( get_the_time( get_option('date_format', 'd M Y') ) ).'</span>';
								}
							echo '</div>';

						echo '</li>';
        
					endwhile;
				echo '</ul>';
			echo $after_widget;

			// Reset the global $the_post as this query will have stomped on it
			wp_reset_postdata();

		endif;

		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('widget_recent_posts', $cache, 'widget');
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
		$instance['show_image'] = isset( $new_instance['show_image'] ) ? (bool) $new_instance['show_image'] : false;
		$instance['width'] = isset( $new_instance['width'] ) ? (int) $new_instance['width'] : 70;
		$instance['height'] = isset( $new_instance['height'] ) ? (int) $new_instance['height'] : 70;

		$instance['insert_type'] = isset( $new_instance['insert_type'] ) ? $new_instance['insert_type'] : 'posts';
		$instance['order_by'] = isset( $new_instance['order_by'] ) ? $new_instance['order_by'] : 'modified';
		$instance['order'] = isset( $new_instance['order'] ) ? $new_instance['order'] : 'desc';
		$instance['id'] = isset( $new_instance['id'] ) ? $new_instance['id'] : '';
		$instance['category'] = isset( $new_instance['category'] ) ? $new_instance['category'] : '';
		$instance['exclude_id'] = isset( $new_instance['exclude_id'] ) ? $new_instance['exclude_id'] : '';
		$instance['exclude_category'] = isset( $new_instance['exclude_category'] ) ? $new_instance['exclude_category'] : '';		
		$instance['number'] = isset( $new_instance['number'] ) ? $new_instance['number'] : 5;

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['widget_recent_entries']) )
			delete_option('widget_recent_entries');

		return $instance;
	}

	function form( $instance ) {

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : esc_html__( 'Recent Posts', 'composer' );
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
		$show_image = isset( $instance['show_image'] ) ?  $instance['show_image'] : false;
		$width = isset( $instance['width'] ) ?  $instance['width'] : 70;
		$height = isset( $instance['height'] ) ?  $instance['height'] : 70;
		$show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;
		$insert_type = ( ! empty( $instance['insert_type'] ) ) ? $instance['insert_type'] : 'posts';
		$order_by = ( ! empty( $instance['order_by'] ) ) ? $instance['order_by'] : 'modified';
		$order = ( ! empty( $instance['order'] ) ) ? $instance['order'] : 'desc';
		$id = ( ! empty( $instance['id'] ) ) ? $instance['id'] : '';
		$category = ( ! empty( $instance['category'] ) ) ? $instance['category'] : '';
		$exclude_id = ( ! empty( $instance['exclude_id'] ) ) ? $instance['exclude_id'] : '';
		$exclude_category = ( ! empty( $instance['exclude_category'] ) ) ? $instance['exclude_category'] : '';
		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
?>
		<p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'composer' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></p>

		<p><label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number of posts to show:', 'composer' ); ?></label>
		<input class="tiny-text" id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="number" step="1" min="1" value="<?php echo esc_attr( $number ); ?>" size="3" /></p>

		<p><input class="checkbox" type="checkbox" <?php checked( $show_date ); ?> id="<?php echo esc_attr( $this->get_field_id( 'show_date' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_date' ) ); ?>" />
		<label for="<?php echo esc_attr( $this->get_field_id( 'show_date' ) ); ?>"><?php esc_html_e( 'Display post date?', 'composer' ); ?></label></p>
        
        <p><input class="checkbox" type="checkbox" <?php checked( $show_image ); ?> id="<?php echo esc_attr( $this->get_field_id( 'show_image' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_image' ) ); ?>" />
		<label for="<?php echo esc_attr( $this->get_field_id( 'show_image' ) ); ?>"><?php esc_html_e( 'Display post image?', 'composer' ); ?></label></p>

		<p><label for="<?php echo esc_attr( $this->get_field_id( 'width' ) ); ?>"><?php esc_html_e( 'Image Width:', 'composer' ); ?></label>
		<input class="tiny-text" id="<?php echo esc_attr( $this->get_field_id( 'width' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'width' ) ); ?>" type="number" step="1" min="1" value="<?php echo esc_attr( $width ); ?>" size="3" /></p>

		<p><label for="<?php echo esc_attr( $this->get_field_id( 'height' ) ); ?>"><?php esc_html_e( 'Image Height:', 'composer' ); ?></label>
		<input class="tiny-text" id="<?php echo esc_attr( $this->get_field_id( 'height' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'height' ) ); ?>" type="number" step="1" min="1" value="<?php echo esc_attr( $height ); ?>" size="3" /></p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'insert_type' ) ); ?>"><?php esc_html_e( 'Insert Type:', 'composer' ); ?></label>
			<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'insert_type' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'insert_type' ) ); ?>">
				<option value="posts" <?php selected( $insert_type, 'posts', true ); ?>><?php esc_html_e( 'Posts', 'composer' ); ?></option>
				<option value="id" <?php selected( $insert_type, 'id', true ); ?>><?php esc_html_e( 'ID', 'composer' ); ?></option>
				<option value="category" <?php selected( $insert_type, 'category', true ); ?>><?php esc_html_e( 'Category', 'composer' ); ?></option>
			</select>
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'order_by' ) ); ?>"><?php esc_html_e( 'Order By:', 'composer' ); ?></label>
			<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'order_by' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'order_by' ) ); ?>">
				<option value="modified" <?php selected( $order_by, 'modified', true ); ?>><?php esc_html_e( 'Modified', 'composer' ); ?></option>
				<option value="date" <?php selected( $order_by, 'date', true ); ?>><?php esc_html_e( 'Date', 'composer' ); ?></option>
				<option value="rand" <?php selected( $order_by, 'rand', true ); ?>><?php esc_html_e( 'Rand', 'composer' ); ?></option>
				<option value="ID" <?php selected( $order_by, 'ID', true ); ?>><?php esc_html_e( 'ID', 'composer' ); ?></option>
				<option value="title" <?php selected( $order_by, 'title', true ); ?>><?php esc_html_e( 'Title', 'composer' ); ?></option>
				<option value="author" <?php selected( $order_by, 'author', true ); ?>><?php esc_html_e( 'Author', 'composer' ); ?></option>
				<option value="name" <?php selected( $order_by, 'name', true ); ?>><?php esc_html_e( 'Name', 'composer' ); ?></option>
				<option value="parent" <?php selected( $order_by, 'parent', true ); ?>><?php esc_html_e( 'Parent', 'composer' ); ?></option>
				<option value="menu_order" <?php selected( $order_by, 'menu_order', true ); ?>><?php esc_html_e( 'Menu Order', 'composer' ); ?></option>
				<option value="none" <?php selected( $order_by, 'none', true ); ?>><?php esc_html_e( 'None', 'composer' ); ?></option>
			</select>
		</p>

		<p>
			<label class="widefat" for="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>"><?php esc_html_e( 'Order:', 'composer' ); ?></label>
			<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'order' ) ); ?>">
				<option value="posts" <?php selected( $order, 'asc', true ); ?>><?php esc_html_e( 'Ascending Order', 'composer' ); ?></option>
				<option value="id" <?php selected( $order, 'desc', true ); ?>><?php esc_html_e( 'Descending Order', 'composer' ); ?></option>
			</select>
		</p>

		<p><label for="<?php echo esc_attr( $this->get_field_id( 'id' ) ); ?>"><?php esc_html_e( 'Post ID', 'composer' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'id' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'id' ) ); ?>" type="text" value="<?php echo esc_attr( $id ); ?>" size="3" /></p>

		<p><label for="<?php echo esc_attr( $this->get_field_id( 'category' ) ); ?>"><?php esc_html_e( 'Category', 'composer' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'category' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'category' ) ); ?>" type="text" value="<?php echo esc_attr( $category ); ?>" size="3" /></p>

		<p><label for="<?php echo esc_attr( $this->get_field_id( 'exclude_id' ) ); ?>"><?php esc_html_e( 'Exclude Id', 'composer' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'exclude_id' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'exclude_id' ) ); ?>" type="text" value="<?php echo esc_attr( $exclude_id ); ?>" size="3" /></p>

		<p><label for="<?php echo esc_attr( $this->get_field_id( 'exclude_category' ) ); ?>"><?php esc_html_e( 'Exclude Category', 'composer' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'exclude_category' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'exclude_category' ) ); ?>" type="text" value="<?php echo esc_attr( $exclude_category ); ?>" size="3" /></p>


<?php
	}
}

function composer_recent_post_widget_init(){
	register_widget('Composer_Recent_Post_Widget');	
}
add_action('widgets_init','composer_recent_post_widget_init');