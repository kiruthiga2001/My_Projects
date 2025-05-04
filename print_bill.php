<?php session_start(); ?>
<html>
<head>
  <title>Print Bill</title>
  <link rel="stylesheet" href="css/bootstrap.css" />
  <script>
    function printBill() {
      window.print();
    }
  </script>
</head>
<body>
  <div class="container mt-4">
    <h2>Final Bill</h2>
    <?php
    if (!empty($_SESSION['orders']) && !empty($_SESSION['user_details'])) {
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
      echo '<p>Address: '.$_SESSION['user_details']['paymentmethod'].'</p>';

      echo '<button onclick="printBill()" class="btn btn-secondary">Print Bill</button>';
      
      // Clear session after printing
      session_destroy();
    }
    ?>
  </div>
</body>
</html>
