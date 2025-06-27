<?php
session_start();

if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: " . strtok($_SERVER["REQUEST_URI"], '?'));
    exit;
}

$products = [
    1 => ['name' => 'Denim Jacket', 'price' => 1299],
    2 => ['name' => 'Basic Tee', 'price' => 499],
    3 => ['name' => 'Sweatpants', 'price' => 899],
];

if (isset($_POST['register'])) {
    $_SESSION['user'] = [
        'username' => $_POST['username'],
        'password' => $_POST['password'],
        'email' => '',
        'address' => ''
    ];
}

if (isset($_POST['login'])) {
    if ($_POST['username'] == $_SESSION['user']['username'] && $_POST['password'] == $_SESSION['user']['password']) {
        $_SESSION['logged_in'] = true;
    } else {
        echo "<div class='message error'>❌ Login failed.</div>";
    }
}

if (isset($_POST['update_profile'])) {
    $_SESSION['user']['email'] = $_POST['email'];
    $_SESSION['user']['address'] = $_POST['address'];
}

if (isset($_POST['add_to_cart'])) {
    $id = $_POST['product_id'];
    $_SESSION['cart'][$id] = ($_SESSION['cart'][$id] ?? 0) + 1;
}

if (isset($_POST['update_qty'])) {
    $_SESSION['cart'][$_POST['product_id']] = $_POST['quantity'];
}

if (isset($_POST['remove_item'])) {
    unset($_SESSION['cart'][$_POST['product_id']]);
}

if (isset($_POST['place_order'])) {
    $_SESSION['orders'][] = ['items' => $_SESSION['cart'], 'status' => 'Processing'];
    unset($_SESSION['cart']);
}

if (isset($_POST['refund'])) {
    $_SESSION['orders'][0]['status'] = 'Refunded';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Threadline Shop</title>
  <style>
    * { box-sizing: border-box; }
    body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #6f6565;
    }
    .navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: #111;
      color: white;
      padding: 10px 20px;
    }
    .nav-left, .nav-right {
      display: flex;
      align-items: center;
      gap: 15px;
    }
    .nav-left button, .nav-right button {
      background: none;
      border: none;
      color: white;
      font-weight: bold;
      cursor: pointer;
      font-size: 14px;
    }
    .nav-left button:hover, .nav-right button:hover {
      text-decoration: underline;
    }
    .logo { font-size: 20px; font-weight: bold; }
    .search-bar {
      padding: 5px 10px;
      border-radius: 5px;
      border: none;
    }
    input.search-bar:focus { outline: none; }
    .container {
      background: white;
      padding: 30px;
    }
    .center-box {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
    }
    .welcome {
      font-size: 32px;
      font-weight: bold;
      text-align: center;
      margin: 30px 0 20px;
    }
    .auth-buttons {
      display: flex;
      gap: 15px;
      justify-content: center;
      margin-bottom: 30px;
    }
    .auth-buttons button {
      font-size: 18px;
      padding: 10px 25px;
    }
    form label {
      display: block;
      font-weight: bold;
      margin-top: 10px;
    }
    form input[type="text"],
    form input[type="password"],
    form input[type="number"] {
      width: 300px;
      padding: 10px;
      font-size: 14px;
      border: 1px solid #ccc;
      border-radius: 5px;
      margin-bottom: 10px;
}

    button {
      background-color: #3498db;
      color: white;
      padding: 8px 15px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    button:hover { background-color: #2980b9; }
    .message {
      background-color: #eafaf1;
      border-left: 5px solid #2ecc71;
      padding: 10px;
      margin-bottom: 15px;
      border-radius: 5px;
    }
    .error {
      background-color: #fdecea;
      border-left-color: #e74c3c;
    }
    .product {
      border: 1px solid #ddd;
      padding: 10px;
      margin-bottom: 10px;
      border-radius: 5px;
      background: #f9f9f9;
    }
  </style>
</head>
<body>

  <div class="navbar">
    <div class="nav-left">
      <?php if (!empty($_SESSION['logged_in'])): ?>
        <button>ADULTS</button>
        <button>TEENS</button>
        <button>KIDS</button>
      <?php endif; ?>
    </div>
    <div class="logo">THREADLINE</div>
    <div class="nav-right">
      <?php if (!empty($_SESSION['logged_in'])): ?>
        <input type="text" class="search-bar" placeholder="SEARCH" />
        <button class="icon">🔍</button>
        <button class="icon">🛍️</button>
        <button class="icon">👤</button>
      <?php endif; ?>
    </div>
  </div>

  <div class="container">
    <?php if (empty($_SESSION['logged_in'])): ?>
      <div class="center-box">
        <div class="welcome">Welcome to THREADLINE</div>
        <div class="auth-buttons">
          <form method="post"><button name="show_register">Sign Up</button></form>
          <form method="post"><button name="show_login">Sign In</button></form>
        </div>
      </div>
    <?php else: ?>
      <p>👋 Hello, <?= $_SESSION['user']['username'] ?> | <a href="?logout=true">Logout</a></p>
    <?php endif; ?>

    <?php if (isset($_POST['show_register'])): ?>
      <h2>User Registration</h2>
      <form method="post">
        <label>Username:</label>
        <input type="text" name="username" required>

        <label>Password:</label>
        <input type="password" name="password" required>

        <button name="register">Register</button>
      </form>
    <?php endif; ?>

    <?php if (isset($_POST['show_login'])): ?>
      <h2>User Login</h2>
      <form method="post">
        <label>Username:</label>
        <input type="text" name="username" required>

        <label>Password:</label>
        <input type="password" name="password" required>

        <button name="login">Login</button>
      </form>
    <?php endif; ?>

    <?php if (!empty($_SESSION['logged_in'])): ?>
      <h2>Profile Management</h2>
      <form method="post">
        <label>Email:</label>
        <input name="email" value="<?= $_SESSION['user']['email'] ?>">

        <label>Address:</label>
        <input name="address" value="<?= $_SESSION['user']['address'] ?>">

        <button name="update_profile">Update</button>
      </form>

      <h2>Product Catalog</h2>
      <form method="get">
        <label>Search:</label>
        <input name="search">
        <button>Search</button>
      </form>
      <?php
        $query = $_GET['search'] ?? '';
        foreach ($products as $id => $p):
          if (!$query || stripos($p['name'], $query) !== false): ?>
            <div class="product">
              <strong><?= $p['name'] ?></strong> – ₱<?= number_format($p['price'], 2) ?>
              <form method="post">
                <input type="hidden" name="product_id" value="<?= $id ?>">
                <button name="add_to_cart">Add to Cart</button>
              </form>
            </div>
      <?php endif; endforeach; ?>

      <h2>Shopping Cart</h2>
      <?php if (!empty($_SESSION['cart'])): foreach ($_SESSION['cart'] as $id => $qty): ?>
        <div class="product">
          <form method="post">
            <?= $products[$id]['name'] ?> – ₱<?= number_format($products[$id]['price'], 2) ?> ×
            <input type="number" name="quantity" value="<?= $qty ?>" min="1">
            <input type="hidden" name="product_id" value="<?= $id ?>">
            <button name="update_qty">Update</button>
            <button name="remove_item">Remove</button>
          </form>
        </div>
      <?php endforeach; ?>
        <form method="post"><button name="place_order">Place Order</button></form>
      <?php else: ?>
        <p>Your cart is empty.</p>
      <?php endif; ?>

      <h2>Order History</h2>
      <?php if (!empty($_SESSION['orders'])): foreach ($_SESSION['orders'] as $index => $order): ?>
        <div class="product">
          <p><strong>Order <?= $index + 1 ?></strong> (<?= $order['status'] ?>)</p>
          <ul>
            <?php foreach ($order['items'] as $id => $qty): ?>
              <li><?= $products[$id]['name'] ?> × <?= $qty ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
      <?php endforeach; ?>
        <form method="post"><button name="refund">Request Refund</button></form>
      <?php else: ?>
        <p>No orders yet.</p>
      <?php endif; ?>
    <?php endif; ?>
  </div>
</body>
</html>
