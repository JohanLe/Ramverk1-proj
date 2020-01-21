<?php

namespace Anax\User;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Anax\User\HTMLForm\CreateForm;
use Anax\User\HTMLForm\EditForm;
use Anax\User\HTMLForm\DeleteForm;
use Anax\User\HTMLForm\UpdateForm;
use Anax\User\HTMLForm\LoginForm;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A sample controller to show how a controller class can be implemented.
 */
class UserController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;



    /**
     * @var $data description
     */
    //private $data;



    // /**
    //  * The initialize method is optional and will always be called before the
    //  * target method/action. This is a convienient method where you could
    //  * setup internal properties that are commonly used by several methods.
    //  *
    //  * @return void
    //  */
    // public function initialize() : void
    // {
    //     ;
    // }



    /**
     * Show all items.
     *
     * @return object as a response object
     */
    public function indexActionGet() : object
    {
        $page = $this->di->get("page");
        $user = new User();
        $user->setDb($this->di->get("dbqb"));

        $page->add("user/crud/view-all", [
            "items" => $user->findAll(),
        ]);

        return $page->render([
            "title" => "Questions",
        ]);
    }


        /**
     * Show a single user
     *
     * @return object as a response object
     */
    public function viewActionGet($userId) : object
    {
        $page = $this->di->get("page");
        $user = new User();
        $user->setDb($this->di->get("dbqb"));

        $question = new \Anax\Question\Question();
        $question->setDb($this->di->get("dbqb"));

        $answer = new \Anax\Answer\Answer();
        $answer->setDb($this->di->get("dbqb"));

        $userDetails = $user->findWhere("id = ?", $userId);
        $questions = $question->findAllWhere("userId = ?", $userId);
        $answers = $answer->findAllWhere("userId = ?", $userId);

        $page->add("user/crud/view-user-activity", [
            "user"=> $userDetails,
            "questions" => $questions,
            "answers" => $answers,
        ]);

        return $page->render([
            "title" => "User: " . $userDetails->username,
        ]);
    }


    public function logoutAction()
    {

        $userHelper = new \Anax\User\UserHelper();

        $userHelper->logout();
        header("Location: ../");
    }

    /**
     * Handler with form to create a new item.
     *
     * @return object as a response object
     */
    public function createAction() : object
    {
        $page = $this->di->get("page");
        $form = new CreateForm($this->di);
        $form->check();

        $page->add("user/crud/create", [
            "form" => $form->getHTML(),
        ]);

        return $page->render([
            "title" => "Create a item",
        ]);
    }



    /**
     * Handler with form to delete an item.
     *
     * @return object as a response object
     */
    public function deleteAction() : object
    {
        $page = $this->di->get("page");
        $form = new DeleteForm($this->di);
        $form->check();

        $page->add("user/crud/delete", [
            "form" => $form->getHTML(),
        ]);

        return $page->render([
            "title" => "Delete an item",
        ]);
    }



    /**
     * Handler with form to update an item.
     *
     * @param int $id the id to update.
     *
     * @return object as a response object
     */
    public function updateAction() : object
    {
        $userHelper = new \Anax\User\UserHelper();
        $page = $this->di->get("page");

        if (!$userHelper->isLoggedIn()) {
            $page->add("user/crud/error", [
                "msg" => "Login or Register",
            ]);
    
            return $page->render();
        }
        $user = $userHelper->getUser();
        $form = new UpdateForm($this->di, $user['id']);
        $form->check();

        $page->add("user/crud/update", [
            "form" => $form->getHTML(),
        ]);

        return $page->render([
            "title" => "Update an item",
        ]);
    }
        /**
     * Description.
     *
     * @param datatype $variable Description
     *
     * @throws Exception
     *
     * @return object as a response object
     */
    public function loginAction() : object
    {
        $page = $this->di->get("page");
        $form = new LoginForm($this->di);
        $form->check();

        $page->add("anax/v2/article/default", [
            "content" => $form->getHTML(),
        ]);

        return $page->render([
            "title" => "A login page",
        ]);
    }
}
