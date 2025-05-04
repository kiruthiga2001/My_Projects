<?php session_start(); ?>
<html>
<head>
  <title>Order Summary</title>
  <link rel="stylesheet" href="css/bootstrap.css" />
</head>
<body style="background:#e0ba7e;">
  <div class="container mt-4">
    <h2>Order Summary</h2>
    <?php
    if (!empty($_SESSION['orders']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
      $_SESSION['user_details'] = [
        'name' => $_POST['name'],
        'phone' => $_POST['phone'],
        'address' => $_POST['address']
      ];
      
      echo '<table class="table">';
      echo '<tr><th>Dish</th><th>Quantity</th><th>Price</th><th>Total</th></tr>';
      $grandTotal = 0;
      foreach ($_SESSION['orders'] as $order) {
        echo '<tr><td>'.$order['dish'].'</td><td>'.$order['quantity'].'</td><td>'.$order['price'].'</td><td>'.$order['total'].'</td></tr>';
        $grandTotal += $order['total'];
      }
      echo '<tr><th colspan="3">Grand Total</th><th>'.$grandTotal.'</th></tr>';
      echo '</table>';
      
      echo '<h3>User Details</h3>';
      echo '<p>Name: '.$_SESSION['user_details']['name'].'</p>';
      echo '<p>Phone: '.$_SESSION['user_details']['phone'].'</p>';
      echo '<p>Address: '.$_SESSION['user_details']['address'].'</p>';

      echo '<form action="print_bill.php" method="post">
              <button type="submit" class="btn btn-primary">Order Now</button>
            </form>';
    }
    ?>
  </div>
</body>
</html>
