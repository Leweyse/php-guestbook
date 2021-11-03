<?php
declare(strict_types=1);

function messageSection($arr) {
    foreach ($arr as $msg) {
        $title = $msg['title'];
        $date = $msg['date'];
        $content = $msg['content'];
        $author = $msg['author'];

        infoComponent($title, $date, $content, $author);
    }
}