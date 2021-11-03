<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Guestbook</title>
</head>
<body>
    <main>
        <form method="post">
            <fieldset>
                <legend>Address</legend>

                <label for="title">Title</label>
                <input type="text" id="title" name="title" class="form-input" value="<?php  ?>" autofocus>

                <label for="date">Date</label>
                <input type="text" id="date" name="date" class="form-input" value="<?php ?>">
        
                <label for="content">Content</label>
                <textarea id="content" name="content" cols="35" rows="4"></textarea>

                <label for="author">Author Name</label>
                <input type="text" id="author" name="author" class="form-input" value="<?php ?>">

                <input type="submit" class="" value="Order!">
            </fieldset>
        </form>
    </main>
</body>
</html>