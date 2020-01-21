<?php

namespace Anax\View;

/**
 * Template file to render a view.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());


$userHelper = new \Anax\User\UserHelper();
?><span class="site-logo" >
    <img src="<?= asd ?>" alt="<?= $siteLogoAlt ?>">
</span>
