<?php
session_start();

class SharedValue {
    public static $value = 0;

    public static function increment() {
        if (!isset($_SESSION['counter'])) {
            $_SESSION['counter'] = 0;
        }
        $_SESSION['counter']++;
    }

    public static function getValue() {
        return isset($_SESSION['counter']) ? $_SESSION['counter'] : 0;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['name'])) {
        $name = htmlspecialchars($_POST['name']);
        $_SESSION['name'] = $name;
        echo "Name stored in session: " . $_SESSION['name'];
    }

    if (isset($_POST['increment'])) {
        SharedValue::increment();
    }
}
?>

<form method="post" action="">
    <label for="name">Enter your name:</label>
    <input type="text" id="name" name="name" required>
    <button type="submit">Submit</button>
</form>

<form method="post" action="" style="margin-top: 10px;">
    <input type="hidden" name="increment" value="1">
    <button type="submit">Increment</button>
</form>

<p>Current value: <?php echo SharedValue::getValue(); ?></p>
