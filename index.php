<?php
declare(strict_types=1);

// require 'models/[...].php';

// session_start();

// include "helpers/[...].php";

include "components/error.component.php";
include "components/success.component.php";

// include "sections/[...].section.php";

if($_SERVER['REQUEST_METHOD']=='POST') {
    $post = new Post();
}

require 'public/view.php';