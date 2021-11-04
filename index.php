<?php
declare(strict_types=1);

require "models/PostLoader.php";
require "models/Post.php";

include "helpers/test_input.php";

include "components/info.component.php";
include "components/error.component.php";

include "sections/messages.section.php";

if($_SERVER['REQUEST_METHOD']=='POST') {
    $post = new Post();
    $post -> setValidation();

    if ($post -> getValidation()) {
        $loader = new PostLoader($post);
        $loader -> setEncoded();
    }
}

require 'public/view.php';
