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

?>
<?php if ($userHelper->isLoggedIn()) : ?>
    <?php $user = $userHelper->getUser(); ?>
    
    <h4 class="create-question-button"><a  href="./question/create"> New Question</a> </h5>
<?php endif; ?>
   
    <h1>Questions</h1>

<?php if (!$questions) : ?>
    <p>There are no questions to show.</p>
    <?php return;
endif; ?>
<div class="questions">
    <?php foreach ($questions as $question) : ?>
        <div class="item">
            <a href="<?= url("question/view/{$question->id}"); ?>"><?= $question->title ?></a>

            <p> Asked by:<?= $question->username ?>  </p>
            <p><?= $question->date ?>  </p>
        </div>
        
    <?php endforeach; ?>
</div>
