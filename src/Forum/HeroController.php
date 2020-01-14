<?php

namespace Anax\Forum;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;


class HeroController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;


    public function indexAction() : object
    {
        
        $page = $this->di->get("page");

        $page->add("anax/forum/index");

        return $page->render();
    }


}
