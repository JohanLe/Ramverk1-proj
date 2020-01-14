<?php

namespace Anax\Home;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;


class HomeController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;


    public function indexAction() : object
    {
        $page = $this->di->get("page");
        $question = new \Anax\Question\Question();
        $question->setDb($this->di->get("dbqb"));

        $tag = new \Anax\Tag\Tag();
        $tag->setDb($this->di->get("dbqb"));

        $user = new \Anax\User\User();
        $user->setDb($this->di->get("dbqb"));

        $page->add("home/index", [
            "questions" => $question->findAll(),
            "tags" => $tag->findAll(),
            "users" => $user->findAll()
        ]);

        return $page->render();
    }


}
