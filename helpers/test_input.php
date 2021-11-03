<?php
declare(strict_types=1);

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = preg_replace('/[[:space:]]+/', '-', $data);
    $data = htmlspecialchars($data);

    return $data;
}