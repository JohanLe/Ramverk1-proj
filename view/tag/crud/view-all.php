<?php

namespace Anax\View;

/**
 * View to display all books.
 */
// Show all incoming variables/functions
//var_dump(get_defined_functions());
//echo showEnvironment(get_defined_vars());

// Gather incoming variables and use default values if not set
$tags = isset($tags) ? $tags : null;

$userHelper = new \Anax\User\UserHelper();

?>


<h1>Tags </h1>

    <?php foreach ($tags as $tag) : ?>
        <a href="<?= url("tag/view/{$tag->id}"); ?>"><?= $tag->text ?></a> | 

    <?php endforeach; ?>
</table>
