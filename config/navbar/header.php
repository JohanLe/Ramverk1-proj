<?php
/**
 * Supply the basis for the navbar as an array.
 */
return [
    // Use for styling the menu
    "wrapper" => null,
    "class" => "my-navbar rm-default rm-desktop",
    // Here comes the menu items
    "items" => [
        [
            "text" => "Home",
            "url" => "",
            "title" => "Första sidan, börja här.",
        ],
        [
            "text" => "Questions",
            "url" => "question",
            "title" => "All questions",
        ],
        [
            "text" => "Users",
            "url" => "user",
            "title" => "All users.",
        ],
        [
            "text" => "Tags",
            "url" => "tag",
            "title" => "All tags.",
        ],
        [
            "text" => "User",
            "url" => "user/update",
            "title" => "User.",
            "submenu" => [
                "items" => [
                    [
                        "text" => "Login",
                        "url" => "user/login",
                        "title" => "login",
                    ],
                    [
                        "text" => "Register",
                        "url" => "user/Create",
                        "title" => "Register",
                    ],
                    [
                        "text" => "Logout",
                        "url" => "user/logout",
                        "title" => "Logout",
                    ],
                ],
            ],
        ],
        [
            "text" => "About",
            "url" => "om",
            "title" => "Om denna webbplats.",
        ],
        
    ],
];
