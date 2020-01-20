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
<?php if($userHelper->isLoggedIn()) : 
    $user = $userHelper->getUser();
    ?>
    
    <h5 class="user-info"><?= $userHelper->logedInAs()?> </h5>
    <a href="./question/create"> New question</a> 
<?php endif; ?>
   
    <h1>View all items</h1>

<?php if (!$questions) : ?>
    <p>There are no questions to show.</p>
<?php 
    return;
endif;

?>


    <?php foreach ($questions as $question) : ?>

        <a href="<?= url("question/view/{$question->id}"); ?>"><?= $question->title ?></a>

        <p> Asked by:<?= $question->username ?>  </p>
        <p>Date: <?= $question->date ?>  </p>
        ___________________________________ </br>
    <?php endforeach; ?>
</table>
