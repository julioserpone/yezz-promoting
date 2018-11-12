<?php namespace app\Helpers;

/**
 * Yezz club - Menu Functions Helper
 *
 * @author  Julio Hernandez <juliohernandezs@gmail.com>
 */

use App\MenuRoute;

class Menu {
    /**
     * sideBar Menu
     * @param output type [json or array]
     * @return [json o array]
     *
     * The array content has to be a least [route, text]
     *
     * Array format > [route, text, badge cont, divider, class, icon]
     *
 * @author  Julio Hernandez <juliohernandezs@gmail.com>
     */
    public static function sideBar($returnArray = true) {
  
        //Busqueda de los items de menu principales
        /*$items = MenuRoute::where('parent_id', null)->get();
        $menu = [];

        foreach ($items as $item) {

            $menu = array_merge($menu, [
                ['route' => ($item->route) ? route($item->route) : '/', 'text' => $item->name, 'icon' => $item->icon, 'code' => $item->code, 'id' => $item->id]
            ]);
            
        }
*/
        $items = MenuRoute::all();
        $menu = [];

        foreach ($items as $item) {

            $menu = array_merge($menu, [
                ['route' => ($item->route) ? route($item->route) : '/', 'text' => $item->name, 'icon' => $item->icon, 'code' => $item->code, 'id' => $item->id, 'parent_id' => $item->parent_id]
            ]);
            
        }
        return $returnArray ? $menu : json_encode($menu);
    }

    public static function subMenu($key, $items) {

        /*$menu[$key] = [];
        $items = MenuRoute::where('parent_id', $key)->get();

        if ($items) {
            foreach ($items as $item) {
                $menu[$key]  = array_merge($menu[$key] , [
                    ['route' => ($item->route) ? route($item->route) : '/', 'text' => $item->name, 'icon' => $item->icon, 'code' => $item->code, 'id' => $item->id]
                ]);
            }
        }*/

        $menu[$key] = [];
        foreach ($items as $item) {

            if ($item['parent_id'] == $key) {
                
                $menu[$key]  = array_merge($menu[$key] , [
                    ['route' => ($item['route']) ? $item['route'] : '', 'text' => $item['text'], 'icon' => $item['icon'], 'code' => $item['code'], 'id' => $item['id'], 'parent_id' => $item['parent_id']]
                ]);
            }
        }

        return $menu[$key];
    }

}
