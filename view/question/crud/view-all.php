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
$urlToCreate = url("question/create");
$urlToDelete = url("question/delete");



?><h1>View all items</h1>

<?php if (!$items) : ?>
    <p>There are no items to show.</p>
<?php
    return;
endif;
?>


    <?php foreach ($items as $item) : ?>

        <a href="<?= url("question/update/{$item->id}"); ?>"> Q_id: <?= $item->id ?></a>

        <p> Title <?= $item->title ?>  </p>
        <p> user_id:<?= $item->user_id ?>  </p>
        <p>Text: <?= $item->text ?>  </p>
        
        <p>Date: <?= $item->date ?>  </p>
        ___________________________________ </br>
    <?php endforeach; ?>
</table>
