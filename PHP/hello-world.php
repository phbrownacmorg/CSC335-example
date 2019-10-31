<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>&ldquo;Hello, World&rdquo; in PHP</title>
</head>
<body>
    <?php echo '<p>Hello, world!</p>'; ?>
    <div>
        <p><?php echo $_SERVER['HTTP_USER_AGENT']; ?></p>
        <p><?php 
            if (strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome') !== FALSE) { 
            ?>
            Your browser <em>claims</em> to be Chrome.  Beware of
            the hunger of the Alphabet!
            <?php } else { ?>
            Your browser does not claim to be Chrome.  You <em>might</em>
            be using a browser that doesn't hunger for world domination (but
            don't bet too much on it).
        <?php } ?>
        </p>
        <p><?php if ($_GET) { ?>
            Hello, <?php echo htmlspecialchars($_GET['name']) ?>.  Asked about your quest, you said 
            &ldquo;<?php echo htmlspecialchars($_GET['quest']) ?>&rdquo;.</p>
            <p>Refresh the page (without the GET part) to get the form back.</p>
        <?php } else { ?>
            <form action="hello-world.php" method="get">
            <label for="name">What is your name?</label><input name="name" id="name" type="text" /><br />
            <label for="name">What is your quest?</label><input name="quest" id="quest" type="text" /><br />
            <input type="submit" />
            </form>
        <?php } ?>
        </p>
            
        <?php
            // phpinfo(); 
        ?>
    </div>
</body>
</html>