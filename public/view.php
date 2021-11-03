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
                <input type="text" id="title" name="title" class="form-input" value="<?php if (count($_POST)) echo $_POST["title"] ?>" autofocus>

                <label for="content">Content</label>
                <textarea id="content" name="content" cols="35" rows="4"><?php if (count($_POST)) echo $_POST["content"] ?></textarea>

                <label for="author">Author Name</label>
                <input type="text" id="author" name="author" class="form-input" value="<?php if (count($_POST)) echo $_POST["author"] ?>">

                <input type="submit" class="" value="Order!">
            </fieldset>
        </form>

        <section>
            <?php
                $jsonData = file_get_contents("data.json");
                $decode = json_decode($jsonData, true);

                if (isset($decode['data'])) echo messageSection($decode['data']);
             ?>
        </section>
    </main>
</body>
</html>