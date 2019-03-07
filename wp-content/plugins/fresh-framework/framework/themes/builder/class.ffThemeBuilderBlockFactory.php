<?php

class ffThemeBuilderBlockFactory extends ffFactoryAbstract {
    /**
     * @param $blockClassName
     * @return ffThemeBuilderBlock
     * @throws Exception
     */
    public function createBlock( $blockClassName ) {
        $this->_getClassloader()->loadClass( $blockClassName );

        $optionsExtender = new ffThemeBuilderOptionsExtender();

        $newClass = new $blockClassName( $optionsExtender );
        return $newClass;
    }
}