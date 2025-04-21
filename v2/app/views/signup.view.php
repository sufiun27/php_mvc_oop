<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="signup" method="POST">
    <?php if(!empty($errors)):?>
      <div class="alert alert-danger">
        <?= implode("<br>", $errors)?>
      </div>
    <?php endif;?>
        <h2>Sign Up</h2>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        <br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <div class="">
      <label>
        <input name="terms" type="checkbox" value="1"> Accept terms
      </label>
    </div>
        <button type="submit">Sign Up</button>
    </form>
</body>
</html>