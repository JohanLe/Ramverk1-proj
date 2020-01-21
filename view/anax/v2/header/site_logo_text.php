<?php

namespace Anax\View;

/**
 * Template file to render a view.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

$userHelper = new \Anax\User\UserHelper();

?><span class="site-logo-text" >
    <a href="<?= url($homeLink) ?>">
        <?php if (isset($siteLogoTextIcon)) : ?>
        <span class="site-logo-text-icon" >
        </span>
        <?php endif; ?>
        <?= $userHelper->logedInAs() ?>
    </a>
</span>
