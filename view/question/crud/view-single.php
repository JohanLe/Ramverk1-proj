<?php

namespace Anax\View;

/**
 * View to display all books.
 */
// Show all incoming variables/functions
//var_dump(get_defined_functions());
//echo showEnvironment(get_defined_vars());

// Gather incoming variables and use default values if not set
$items = isset($items) ? $items : null;

$userHelper = new \Anax\User\UserHelper();
use Michelf\Markdown;

?>

<?php

if (!$question) : ?>
    <p>There are no items to show.</p>
    <?php return;
endif; ?>

    <article class="single-view-main-content">
        <div>
            <h2> <?= ($question->title) ?></h4>
        </div>
        <div class="single-view-question">
            <p> <?= Markdown::defaultTransform($question->text); ?></p>
        </div>
 
        <div class="single-view-footer">
            <p > Written by: <?= $question->username ?> | <?= $question->date ?>  </h4>
            </br>
            <?php if ($userHelper->getUser()) : ?>
                <div class="footer-reply">
                    <a href="../../answer/create?qid=<?= $question->id?>">Answer</a> |
                    <a href="../../comment/create?qid=<?= $question->id?>">Comment</a>
                </div>
            <?php endif; ?>
        </div>
        
    </article>

    <?php foreach ($question->comments as $comment) : ?>
        <div class="single-view-comment">
            <div lass="single-view-text">
 
                <p> <?= Markdown::defaultTransform($comment->text); ?></p>
            </div>

            <div class="single-view-footer">
                <p> <?= ($comment->username) ?> | <?= ($comment->date) ?></h4>
            </div>
        </div>

    <?php endforeach; ?>

    <?php foreach ($answers as $answer) : ?>
        <div class="single-view-answer">
            <div>
                <p> <?= Markdown::defaultTransform($answer->text); ?></p>
            </div>

        <div class="single-view-footer">
            <p> <?= ($answer->username) ?> | <?= ($answer->date) ?></h4>
            <?php if ($userHelper->isLoggedIn()) : ?>
                <a href="../../comment/create?qid=<?= $question->id?>&aid=<?= $answer->id?>">Comment</a>
            </div>
            <?php endif; ?>
        </div>
        <?php if (property_exists($answer, "comments")) : ?>
            <?php foreach ($answer->comments as $comment) : ?>
                <div class="single-view-comment">
                    <div lass="single-view-text">
                    <p> <?= Markdown::defaultTransform($comment->text); ?></p>
                </div>

                <div class="single-view-footer">
                    <p> <?= ($comment->username)?> | <?= ($comment->date) ?></h4>
                </div>
            </div>
            <?php endforeach; ?>
        <?php endif; ?>
    
    <?php endforeach; ?>


</table>
