<?php

namespace Anax\View;

$userHelper = new \Anax\User\UserHelper();
use Michelf\Markdown;

// Gather incoming variables and use default values if not set
$items = isset($items) ? $items : null;

// Create urls for navigation
$urlToViewItems = url("answer");

if($question == null){
    echo ("Question not found. try again");
    return false;
}
echo($userHelper->logedInAs());
?>

<h1>Answer  </h1>
<article class="single-view-main-content">
        <div>
            <h2> <?= ($question->title) ?></h4>
        </div>
        <div class="single-view-question">
        
<p> <?= Markdown::defaultTransform($question->text); ?></p>
        </div>
 
        <div class="single-view-footer">
            <p class="footer-date"> <?= ($question->date) ?></h4>
            <p class="footer-author"> <?= ($question->user_id) ?></h4>
            </br>
        </div>
        
    </article>


<?= $form ?>


<p>
    <a href="<?= $urlToViewItems ?>">View all</a>
</p>
