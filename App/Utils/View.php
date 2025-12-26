<?php

namespace App\Utils;

class View{

    private static $vars = [];

    public static function init($vars = []){
        self::$vars = $vars;
    }
    private static function getContentView($view){
        $file = __DIR__ . '/../../resources/views/' . $view .'.html';

        return file_exists($file) ? file_get_contents($file) : '';
    }

    public static function render($view, $vars = []){
        // Carregar o conteúdo da view
        
        $contentView = self::getContentView($view);

        $vars = array_merge(self::$vars, $vars);

        $keys = array_keys($vars);
        $keys = array_map(function($item){
            return '{{' . $item . '}}';
        }, $keys);

        return str_replace($keys,array_values($vars), $contentView);
    }

    public static function renderMenu($contexto) {
        $menus = json_decode(file_get_contents('menus.json'), true);
        $itens = $menus[$contexto] ?? [];
        
        $html = '';
        foreach ($itens as $item) {
            $html .= View::render('layout/menu_item', [
                'link'  => $item['link'],
                'label' => $item['label'],
                'icon'  => $item['icon']
            ]);
        }
    return $html;
}
}