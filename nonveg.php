<html>
<head>
  <title>Food Website - Non-Veg</title>
  <link rel="stylesheet" href="css/bootstrap.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>
  <div class="container-fluid" style="height:700px;background:#fffdd0;">
    <div class="row"> 
      <div class="col-md-12" style="height:80px;background:#e0ba7e;">
        <center><b><i><h1>NON-VEG</h1></i></b></center>
      </div>
      <div class="col-md-12" style="height:620px;">
        <div class="row">
          <?php
          // Non-Veg Dishes with prices
          $dishes = [
              ['name' => 'CHICKEN MEALS', 'image' => 'image/54.png', 'price' => 150],
              ['name' => 'MUTTON BIRYANI', 'image' => 'image/53.png', 'price' => 200],
              ['name' => 'EGG FRIED RICE', 'image' => 'image/55.png', 'price' => 120],
              ['name' => 'CHICKEN STARTERS', 'image' => 'image/56.png', 'price' => 180],
              ['name' => 'MUTTON KEBABS', 'image' => 'image/51.png', 'price' => 220],
              ['name' => 'FISH NOODLES', 'image' => 'image/52.png', 'price' => 140]
          ];
          foreach ($dishes as $dish) {
            echo '
              <div class="col-md-3" style="border:1px solid #000; height:200px; margin:30px; border-radius:12px; background:url('.$dish['image'].'); background-size:cover;">
                <div class="transparent-box" style="width:100px; height:100px; background-image:url('.$dish['image'].');">
                  <center><i><b><h3><font size=2 color="black">'.$dish['name'].'</font></h3></b></i></center>
                  <center><b><p>Price: ₹'.$dish['price'].'</p></b></center>
                  <a href="order.php?dish='.urlencode($dish['name']).'&price='.$dish['price'].'" class="btn btn-primary btn-sm">Order</a>
                </div>
              </div>';
          }
          ?>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
