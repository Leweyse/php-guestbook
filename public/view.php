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
        <section class="form-section">
            <form method="post">
                <fieldset>
                    <legend>Leave your message!</legend>

                    <div class="form_input">
                        <label for="title">Title</label>
                        <input type="text" id="title" name="title" value="<?php if (count($_POST)) echo $_POST["title"] ?>" autocomplete="FALSE" autofocus>
                    </div>

                    <div class="form_input">
                        <label for="content">Content</label>
                        <textarea id="content" name="content" cols="35" rows="4" autocomplete="FALSE"><?php if (count($_POST)) echo $_POST["content"] ?></textarea>
                    </div>

                    <div class="form_input">
                        <label for="author">Author Name</label>
                        <input type="text" id="author" name="author" value="<?php if (count($_POST)) echo $_POST["author"] ?>" autocomplete="FALSE">
                    </div>

                    <input type="submit" class="submit" value="Add Message">
                </fieldset>
            </form>
        </section>

        <section class="msg-section">
            <?php
                $jsonData = file_get_contents("data.json");
                $decode = json_decode($jsonData, true);

                if (isset($decode['data'])) echo messageSection($decode['data']);
             ?>
        </section>
    </main>
</body>
</html>