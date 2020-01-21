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



?><h1><?= $user->username?></h1>

<?php if (!$questions) : ?>
    <p>There are no items to show.</p>
    <?php return;
endif; ?>

<div class="ud-questions-container">
    <h2> Questions asked: </h2>
    <?php foreach ($questions as $question) : ?>
        <div class="ud-question">
        <a href="../../question/view/<?=$question->id?>"> <h4> <?= $question->title?> </h4></a>
            <p> <?= $question->date?> </p>
        </div>

    <?php endforeach; ?>


</div>

<div class="ud-questions-container">
    <h2> Questions answered: </h2>
    <?php foreach ($answers as $answer) : ?>
        <div class="ud-question">
            <a href="../../question/view/<?=$answer->questionId?>"> <h4> <?= $answer->text?> </h4></a>
            <p> <?= $answer->date?> </p>
        </div>

    <?php endforeach; ?>


</div>
