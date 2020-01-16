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

// Create urls for navigation
$urlToCreate = url("question/update");
$urlToDelete = url("question/delete");



?><h1>View all items</h1>

<?php 

if (!$question) : ?>
    <p>There are no items to show.</p>
<?php
    
    return;
endif;
?>


 

    <article class="single-view-main-content">
        <div>
            <h4> <?= ($question->title) ?></h4>
        </div>
        <div class="single-view-question">
            <p> <?= ($question->text) ?></p>
        </div>
 
        <div class="single-view-footer">
            <p class="footer-date"> <?= ($question->date) ?></h4>
            <p class="footer-author"> <?= ($question->user_id) ?></h4>
        </div>
    </article>

    <?php foreach($question->comments as $comment): ?>
        <div class="single-view-comment">
            <div lass="single-view-text">
                <p> <?= ($comment->text) ?></p>
            </div>

            <div class="single-view-footer">
                <p class="footer-date"> <?= ($comment->date) ?></h4>
                <p class="footer-author"> <?= ($comment->user_id) ?></h4>
            </div>
        </div>

    <?php endforeach; ?>

    <?php foreach($answers as $answer): ?>

    
    <div class="single-view-answer">
        <div>
        <p> <?= ($answer->text) ?></p>
    </div>

    <div class="single-view-footer">
        <p class="footer-date"> <?= ($answer->date) ?></h4>
        <p class="footer-author"> <?= ($answer->user_id) ?></h4>
    </div>
    </div>
    <?php foreach($answer->comments as $comment): ?>

            <div class="single-view-comment">
                <div lass="single-view-text">
                    <p> <?= ($comment->text) ?></p>
                </div>

                <div class="single-view-footer">
                    <p class="footer-date"> <?= ($comment->date) ?></h4>
                    <p class="footer-author"> <?= ($comment->user_id) ?></h4>
                </div>
            </div>
        <?php endforeach; ?>

        <?php endforeach; ?>


</table>
