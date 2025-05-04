<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['dish']) && isset($_GET['price'])) {
    // Capture selected dish details from the URL parameters
    $dish = $_GET['dish'];
    $price = $_GET['price'];
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm_order'])) {
    // Get user input from the form
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $dish = $_POST['dish'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $total = $price * $quantity;
    
    // Store the order details in the session to avoid duplicate data on reload
    $_SESSION['order'] = [
        'name' => $name,
        'phone' => $phone,
        'address' => $address,
        'dish' => $dish,
        'price' => $price,
        'quantity' => $quantity,
        'total' => $total
    ];

    // Display order confirmation and bill
    echo '
    <div class="container mt-4">
      <h2>Order Confirmation</h2>
      <p><strong>Name:</strong> ' . htmlspecialchars($name) . '</p>
      <p><strong>Phone:</strong> ' . htmlspecialchars($phone) . '</p>
      <p><strong>Address:</strong> ' . htmlspecialchars($address) . '</p>
      <p><strong>Dish:</strong> ' . htmlspecialchars($dish) . '</p>
      <p><strong>Quantity:</strong> ' . htmlspecialchars($quantity) . '</p>
      <p><strong>Total Bill:</strong> ₹' . number_format($total, 2) . '</p>
      <p>Your order has been placed! You will receive your food within one hour.</p>
      <button onclick="window.print();" class="btn btn-primary">Print Bill</button>
    </div>';
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Order Confirmation</title>
  <link rel="stylesheet" href="css/bootstrap.css" />
</head>
<body style="background:#e0ba7e;">
  <div class="container mt-4">
    <h2>Order Details</h2>
    <form method="post" action="">
      <input type="hidden" name="dish" value="<?php echo htmlspecialchars($dish); ?>">
      <input type="hidden" name="price" value="<?php echo htmlspecialchars($price); ?>">
      
      <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" class="form-control" name="name" required>
      </div>
      
      <div class="form-group">
        <label for="phone">Phone:</label>
        <input type="text" class="form-control" name="phone" required>
      </div>
      
      <div class="form-group">
        <label for="address">Address:</label>
        <textarea class="form-control" name="address" required></textarea>
      </div>
      
      <div class="form-group">
        <label for="quantity">Quantity:</label>
        <input type="number" class="form-control" name="quantity" min="1" max="10" value="1" required>
      </div>
      <div class="form-group">
                <label for="method">payment method: only service cash on delivery</label>
                <select class="form-control" id="method" required>
                    <option   value="cash on delivery">cash on delivery</option>
                </select>
            </div>
      <button type="submit" name="confirm_order" class="btn btn-success">Confirm Order</button>
    </form>
  </div>
</body>
</html>
