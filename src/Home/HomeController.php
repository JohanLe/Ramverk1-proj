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

        $tagActivity = new \Anax\TagActivity\TagActivity();
        $tagActivity->setDb($this->di->get("dbqb"));

        $user = new \Anax\User\User();
        $user->setDb($this->di->get("dbqb"));

        $page->add("home/index", [
            "questions" => $question->orderByWithLimit("date desc", 5),
            "tags" => $tagActivity->mostFrequentTag(3),
            "users" => $user->mostActiveUsers(3)
        ]);

        

            
        return $page->render([
            "title" => "Stuff about Marvels"
        ]);
    }
}
