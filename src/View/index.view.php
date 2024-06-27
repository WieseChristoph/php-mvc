<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts</title>
</head>
<body>
    <form method="post" style="display: flex; flex-direction: column; gap: 10px;">
        <label for="title">Title</label>
        <input type="text" name="title">

        <label for="content">Content</label>
        <textarea name="content"></textarea>

        <input type="submit">
    </form>

    <main>
        <?php
            foreach ($posts as $post) {
        ?>
                <details>
                    <summary><?php echo $post->getTitle() ?></summary>
                    <span><?php echo $post->getContent() ?></span>
                </details>
        <?php 
            }
        ?>
    </main>
</body>
</html>