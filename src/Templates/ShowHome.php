<?php

namespace Templates;

use Mpwarfw\Template\Template;

class ShowHome implements Template
{
    const ROUTE_FOLDER = "../src/Templates";
    const NAME_FILE = "Home.twig";

    public $loader;
    public $twig;

    public function __construct()
    {
        \Twig_Autoloader::register();
        $this->loader = new \Twig_Loader_Filesystem(self::ROUTE_FOLDER);
        $this->twig = new \Twig_Environment($this->loader);

    }

    public function render($value)
    {
      return $this->twig->render(self::NAME_FILE,array('data' =>$value));
    }

}