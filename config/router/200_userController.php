<?php
/**
 * Load the stylechooser as a controller class.
 */
return [
    "routes" => [
        [
            "info" => "User controller",
            "mount" => "user",
            "handler" => "\Anax\User\UserController",
        ],
    ]
];
