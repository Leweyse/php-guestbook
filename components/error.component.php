<?php 
    function errorComponent($error) {
        echo "
            <div class='error_container'>
                <h4>$error</h4>
                <h4>Try again!</h4>
            </div>     
        ";
    }