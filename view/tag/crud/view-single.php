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

?>

<?php

if (!$tag) : ?>
    <p>There are no items to show.</p>
<?php
    
    return;
endif;
?>
    <h3> <?= $tag->text ?> </h3>
    Found in:
    <?php foreach ($questions as $question): ?>

        <a href="../../question/view/<?= $question[0]->id ?>">  <h6><?= $question[0]->title ?> </h6> </a>
    <?php endforeach; ?>


</table>
