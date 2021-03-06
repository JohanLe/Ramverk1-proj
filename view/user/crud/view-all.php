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
<h1>Users</h1>

<?php if (!$items) : ?>
    <p>There are no items to show.</p>
    <?php return;
endif; ?>

    <?php foreach ($items as $item) : ?>
        <a class="list-user" href="<?= url("user/view/{$item->id}"); ?>"><?= $item->username ?></a> |
    <?php endforeach; ?>
</table>
