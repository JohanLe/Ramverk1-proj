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
<h5 class="user-info"><?= $userHelper->logedInAs()?> </h5>
<h1>View all items</h1>

<?php if (!$items) : ?>
    <p>There are no items to show.</p>
<?php
    return;
endif;
?>


    <?php foreach ($items as $item) : ?>

        <a href="<?= url("question/view/{$item->id}"); ?>"><?= $item->title ?></a>

        <p> Written by:<?= $item->user_id ?>  </p>
        <p>Date: <?= $item->date ?>  </p>
        ___________________________________ </br>
    <?php endforeach; ?>
</table>
