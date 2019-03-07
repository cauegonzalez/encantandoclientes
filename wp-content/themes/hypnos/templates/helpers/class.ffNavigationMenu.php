<?php

class ffNavigationMenu extends Walker_Nav_Menu {

	private $_codeToPrint = false;

	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		$output .= '<ul role="menu" class="dropdown-menu">';


		if( $this->_codeToPrint != false && $depth == 0 ) {
			$output .= $this->_codeToPrint;

		}
		$this->_codeToPrint = false;
	}

	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

		$LI_classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$LI_classes[] = 'menu-item-' . $item->ID;

		if ( $args->has_children ){
			$LI_classes[] .= 'dropdown dropdown-toggle nav-toggle';
			if( $depth > 0 ){
				$LI_classes[] .= 'dropdown-submenu';
			}
		}

		if ( in_array( 'current-menu-item', $LI_classes ) ){
			$LI_classes[] = 'active';
		}

		$LI_classes = apply_filters( 'nav_menu_css_class', array_filter( $LI_classes ), $item, $args );
		$LI_classes = implode(' ', $LI_classes);

		$LI_id = 'menu-item-'. $item->ID;
		$LI_id = apply_filters( 'nav_menu_item_id', $LI_id, $item, $args );

		$output .= '<li id="' . esc_attr( $LI_id ) . '" class="' . esc_attr( $LI_classes ) . '">';

		$atts = array(
			'title'         => ! empty( $item->title  ) ? $item->title  : '' ,
			'target'        => ! empty( $item->target ) ? $item->target : '' ,
			'rel'           => ! empty( $item->xfn    ) ? $item->xfn    : '' ,
			'href'          => ! empty( $item->url    ) ? $item->url    : '' ,
			'class'         => 'dropdown-toggle' ,
			'aria-haspopup' => 'true' ,
		);

		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

		$item_output  = '';
		$item_output .= $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		if( $depth < 1 ){
			if ( $args->has_children ){
				if( $depth == 0 ){
					$item_output .= ' <b data-toggle="dropdown" class="caret"></b>';
				}else{
					// ????
					$item_output .= ' <b data-toggle="dropdown" class="caret"></b>';
				}
			}
		}
		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

	}


	public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
        if ( ! $element )
            return;

        $id_field = $this->db_fields['id'];

        // Display this element.
        if ( is_object( $args[0] ) )
           $args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );

        parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }
}

function ffNavigationMenu_fallback( $args ){
	echo '<ul role="menu" id="menu-all-pages" class="slimmenu">';
	wp_list_pages( array(
		'child_of' => 0,
		'title_li' => '',
	) );
	echo '</ul>';
}
