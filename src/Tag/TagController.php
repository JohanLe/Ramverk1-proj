<?php

namespace Anax\Tag;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Anax\Tag\HTMLForm\CreateForm;
use Anax\Tag\HTMLForm\EditForm;
use Anax\Tag\HTMLForm\DeleteForm;
use Anax\Tag\HTMLForm\UpdateForm;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A sample controller to show how a controller class can be implemented.
 */
class TagController implements ContainerInjectableInterface
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
        $tag = new Tag();
        $tag->setDb($this->di->get("dbqb"));

        $page->add("tag/crud/view-all", [
            "tags" => $tag->findAll(),
        ]);

        return $page->render([
            "title" => "A collection of items",
        ]);
    }

            /**
     * Show a single tag
     *
     * @return object as a response object
     */
    public function viewActionGet($tagId) : object
    {
        $page = $this->di->get("page");
        $tag = new Tag();
        $tag->setDb($this->di->get("dbqb"));

        $tagActivity = new \Anax\TagActivity\TagActivity();
        $tagActivity->setDb($this->di->get("dbqb"));

        $question = new \Anax\Question\Question();
        $question->setDb($this->di->get("dbqb"));

        $tagActicities = $tagActivity->findAllWhere("tagId = ?", $tagId);
        $qids = $this->getPropData($tagActicities, "questionId");
       

        $questions = $this->getMultipleObjects($question, $qids, "id");

        $page->add("tag/crud/view-single", [
            "tag" => $tag->findWhere("id = ?", $tagId),
            "questions" => $questions
        ]);

        return $page->render([
            "title" => "Tag"
        ]);
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

        $page->add("tag/crud/create", [
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

        $page->add("tag/crud/delete", [
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
    public function updateAction(int $id) : object
    {
        $page = $this->di->get("page");
        $form = new UpdateForm($this->di, $id);
        $form->check();

        $page->add("tag/crud/update", [
            "form" => $form->getHTML(),
        ]);

        return $page->render([
            "title" => "Update an item",
        ]);
    }

    /**
     * @param Array of values to search in
     * @param "property" to look for.
     * @return Array of prop-data
     */

    public function getPropData($objects, $prop)
    {
        $result = [];

        foreach ($objects as $obj) {
            $result[] = $obj->$prop;
        }
        return $result;
    }

    public function getMultipleObjects($dbObj, $values)
    {
        $result = [];
    
        foreach ($values as $value) {
            $result[] = $dbObj->findAllWhere("id = ?", $value);
        }
        return $result;
    }
}
