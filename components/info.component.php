<?php
declare(strict_types=1);

function infoComponent($title, $date, $content, $author) {
    echo "
        <article>
            <h2>$title</h2>
            <p>$content</p>
            <address>$author</address>
            <time>$date</time>
        </article>          
    ";
}