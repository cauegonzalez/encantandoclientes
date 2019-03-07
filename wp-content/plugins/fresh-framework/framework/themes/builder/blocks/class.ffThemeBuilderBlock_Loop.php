<?php

class ffThemeBuilderBlock_Loop extends ffThemeBuilderBlock {
/**********************************************************************************************************************/
/* OBJECTS
/**********************************************************************************************************************/

/**********************************************************************************************************************/
/* PRIVATE VARIABLES
/**********************************************************************************************************************/

/**********************************************************************************************************************/
/* CONSTRUCT
/**********************************************************************************************************************/
	protected function _init() {
		$this->_setInfo( ffThemeBuilderBlock::INFO_ID, 'loop');
		$this->_setInfo( ffThemeBuilderBlock::INFO_WRAPPING_ID, 'loop');
		$this->_setInfo( ffThemeBuilderBlock::INFO_WRAP_AUTOMATICALLY, true);
		$this->_setInfo( ffThemeBuilderBlock::INFO_IS_REFERENCE_SECTION, true);
		$this->_setInfo( ffThemeBuilderBlock::INFO_SAVE_ONLY_DIFFERENCE, true);
	}
/**********************************************************************************************************************/
/* PUBLIC FUNCTIONS
/**********************************************************************************************************************/

/**********************************************************************************************************************/
/* PUBLIC PROPERTIES
/**********************************************************************************************************************/

/**********************************************************************************************************************/
/* PRIVATE FUNCTIONS
/**********************************************************************************************************************/


	protected function _render( $query ) {

		$args = array();

		/*if param portfolio*/
		if($this->getParam('type') == 'portfolio'){
			$args['post_type'] = 'portfolio';
		}

		$args['posts_per_page'] = $query->getWithoutComparationDefault('posts_per_page', 5);


		$argsString = $query->getWithoutComparationDefault('string-input', '');

		if( !empty( $argsString ) ) {
			parse_str( $argsString, $argsStringParsed );

			$args = array_merge( $args, $argsStringParsed );
		}

		$argsPhp = $query->getWithoutComparationDefault('php-input', '');
		if( !empty( $argsPhp ) ) {
			eval( $argsPhp );
		}


		if( $query->getWithoutComparationDefault('reacts-to-pagination', 1) ) {
			global $wp_query;
			$args['paged'] = $wp_query->get('paged');
		}

		return new WP_Query( $args );
	}

	protected function _injectOptions( ffThemeBuilderOptionsExtender $s ) {

		$s->addElement( ffOneElement::TYPE_TABLE_START );

			$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'General Settings');

				$s->addElement( ffOneElement::TYPE_DESCRIPTION, '', 'Pagination is another element in our builder. If you want this loop the possibility to be paged, then check this. Otherwise it will not react to changeds in your url');
				$s->addOptionNL(ffOneOption::TYPE_CHECKBOX, 'reacts-to-pagination', 'Loop reacts to pagination', 1);

			$s->addElement( ffOneElement::TYPE_TABLE_DATA_END);

			$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Loop Settings');

				$s->addOptionNL(ffOneOption::TYPE_TEXT, 'posts_per_page', 'Posts Per Page', 5);

			$s->addElement( ffOneElement::TYPE_TABLE_DATA_END);


			$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Advanced Loop Settings');

					$s->addOptionNL(ffOneOption::TYPE_TEXTAREA, 'string-input', 'String Input', '');

			$s->addElement( ffOneElement::TYPE_TABLE_DATA_END);

			$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Pro Loop Settings');

				$s->addElement( ffOneElement::TYPE_DESCRIPTION, '', 'Fill PHP code here, which grants you access to $args variable, and of course any other stuff. So you can write $args["posts_per_page"]=5; Do it, only if you are pro, bro :-). Also the $args is created from the two previous inputs. Feel free to var_dump the variable to see more ');

				$s->addOptionNL(ffOneOption::TYPE_TEXTAREA, 'php-input', 'PHP Input', '');

			$s->addElement( ffOneElement::TYPE_TABLE_DATA_END);

		$s->addElement( ffOneElement::TYPE_TABLE_END );
	}
/**********************************************************************************************************************/
/* PRIVATE GETTERS & SETTERS
/**********************************************************************************************************************/
}