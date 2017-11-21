<?php

class HTML {

    public $controller;
    private $doctypes = array(
        'html4-strict' => '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">',
        'html4-trans' => '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">',
        'html4-frame' => '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">',
        'html5' => '<!DOCTYPE html>',
        'xhtml-strict' => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">',
        'xhtml-trans' => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">',
        'xhtml-frame' => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">',
        'xhtml11' => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">'
    );

    public function __construct($controller) {
        $this->controller = $controller;
    }

    public function docType($type = 'html5') {
        return ((isset($this->doctypes[$type])) ? $this->doctypes[$type] : '<!DOCTYPE html>') . "\n";
    }

    public function title($title) {
        return '<title>' . $title . '</title>' . "\n";
    }
    
    public function canonical($page) {
        return '<link rel="canonical" href="https://www.esatus.fr/'.$page.'/">';
    }
    
    public function charset($charset) {
        return '<meta charset="' . $charset . '">' . "\n";
    }

    public function metas($attributes) {
        $metas = '';
        foreach ($attributes as $k => $v) {
            $metas .= '<meta name="' . $k . '" content="' . $v . '">' . "\n";
        }
        return $metas;
    }

    public function favicon() {
        return '<link rel="shortcut icon" href="' . IMAGE . 'favicon.ico">' . "\n";
    }

    public function sitemap() {
        return '<link rel="sitemap" type="application/xml" href="' . Router::url('xml/pages/sitemap') . '">' . "\n";
    }

    public function author() {
        return '<link type="text/plain" rel="author" href="' . Router::url('txt/pages/humans') . '">' . "\n";
    }

    public function webfonts($font) {
        return '<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=' . $font . '">' . "\n";
    }

    public function css($name) {
        return '<link rel="stylesheet" href="' . CSS . $name . '.css">' . "\n";
    }
    
    public function htmlPage($name) {
        return '<link rel="stylesheet" href="' . HTML . $name . '.html">' . "\n";
    }
    
    public function css_admin($name) {
        return '<link rel="stylesheet" href="' . css_admin . $name . '.css">' . "\n";
    }
    
    public function html($name) {
        return '<link rel="stylesheet" href="' . HTML . $name . '.html">' . "\n";
    }
    
    public function js($name) {
        return '<script src="' . JS . $name . '.js"></script>' . "\n";
    }

    public function scripts_for_layout($scripts) {
        $html = '';
        foreach ($scripts as $script) {
            $html .= '<script src="' . JS . $script . '.js"></script>' . "\n";
        }
        return $html;
    }

    public function link($url, $attributes, $anchor) {
        $html = '<a href="' . Router::url($url) . '"';
        if (is_array($attributes)) {
            foreach ($attributes as $k => $v) {
                $html .= ' ' . $k . '="' . $v . '"';
            }
        } else {
            $html .= ' ' . $attributes;
        }
        $html .= '>' . $anchor . '</a>' . "\n";
        return $html;
    }

    public function img($path, $attributes) {
        list($width, $height) = getimagesize(IMAGE . $path);
        $html = '<img src="' . IMAGE . $path . '" width="' . $width . '" height="' . $height . '"';
        if (is_array($attributes)) {
            foreach ($attributes as $k => $v) {
                $html .= ' ' . $k . '="' . $v . '"';
            }
        } else {
            $html .= ' ' . $attributes;
        }
        $html .= '>' . "\n";
        return $html;
    }

}

?>