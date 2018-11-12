<?php namespace app\Helpers;

/**
 * Yezz club - Language Functions Helper
 *
 * @author  Julio Hernandez <juliohernandezs@gmail.com>
 */

class Language {
    /**
     * setLanguage Menu
     * @return [void]
     *
     * @author  Julio Hernandez <juliohernandezs@gmail.com>
     */
    public static function setLanguage() {
  
        \App::setLocale((\Auth::user()) ? \Auth::user()->language : 'en');
    }

}
