<?php

if( !function_exists('ff_add_custom_options_into_menu') ) {

    function ff_add_custom_options_into_menu()
    {
        /**
         * Allow adding custom options into Appearance -> Menu screen
         */
        $menuOpt = ffContainer()->getThemeFrameworkFactory()->getMenuOptionsManager();

        $menuOpt->setOptionsHolderClassName('ffComponent_Theme_MenuOptions');

    }

    ff_add_custom_options_into_menu();
}