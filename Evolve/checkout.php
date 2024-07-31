<?php
include 'header.php';
if (isset($_GET['q'])) {
$totalPrice = $_GET['q'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['cart'] = array();
}
function saveOrder($conn, $order_data)
{
    try {
        $sql = "INSERT INTO orders (name, email, phone, address, city, zip, country, payment_method, total_price, order_date,user_id,total_product)
                VALUES (:name, :email, :phone, :address, :city, :zip, :country, :payment_method, :total_price, :order_date,:user_id,:total_product)";

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':name', $order_data['name']);
        $stmt->bindParam(':email', $order_data['email']);
        $stmt->bindParam(':phone', $order_data['phone']);
        $stmt->bindParam(':address', $order_data['address']);
        $stmt->bindParam(':city', $order_data['city']);
        $stmt->bindParam(':zip', $order_data['zip']);
        $stmt->bindParam(':country', $order_data['country']);
        $stmt->bindParam(':payment_method', $order_data['payment_method']);
        $stmt->bindParam(':total_price', $order_data['total_price']);
        $stmt->bindParam(':user_id', $order_data['user_id']);
        $stmt->bindParam(':total_product', $order_data['total_product']);


        $order_date = date('Y-m-d');
        $stmt->bindParam(':order_date', $order_date);

        if ($stmt->execute()) {
            $delete_cart_query = $conn->prepare("DELETE FROM cart WHERE customer = :user_id");
            $delete_cart_query->bindParam(':user_id', $order_data['user_id'], PDO::PARAM_INT);
            $delete_cart_query->execute();
            header('Location: myorder.php');
            exit();
        } else {
            echo "Error saving order.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $user = $_SESSION['id'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $zip = $_POST['zip'];
    $country = $_POST['country'];
    $payment_method = $_POST['payment'];
    $total_price = $_POST['price'];

    $cart_query = $conn->query("SELECT * FROM cart");
    if($cart_query->rowCount() > 0){
       while($product_item = $cart_query->fetch(PDO::FETCH_ASSOC)){
        $producte = $conn->query("SELECT * FROM products WHERE product_id = " . $product_item['product']);
        while($produ = $producte->fetch(PDO::FETCH_ASSOC)){
          $product_name[] = $produ['product_name'] .' ('. $product_item['quantity'] .') ';
       }
    }
    }
    
    $total_product = implode(', ',$product_name);

    $order_data = array(
        'name' => $name,
        'email' => $email,
        'phone' => $phone,
        'address' => $address,
        'city' => $city,
        'zip' => $zip,
        'country' => $country,
        'payment_method' => $payment_method,
        'user_id' => $user,
        'total_price' => $total_price,
        'total_product' => $total_product
    );

    saveOrder($conn, $order_data);
}
?>
    <title>Checkout</title>
    <link rel="stylesheet" href="css/checkout.css">

<body>
    <div>
        <div>
<div class="display-order">
    <h3>Your Cart</h3><hr>
  <?php
  $product_query = $conn->query("SELECT * FROM cart");
  $cart_items = $product_query->fetchAll(PDO::FETCH_ASSOC);
  $total = 0;
  $grand_total = 0;
  if (count($cart_items) > 0) {
    foreach ($cart_items as $fetch_cart) {
      $producte = $conn->query("SELECT * FROM products WHERE product_id = " . $fetch_cart['product']);
      $cartes = $producte->fetchAll(PDO::FETCH_ASSOC);
      foreach ($cartes as $fetch) {
        $produc = $conn->query("SELECT * FROM cart WHERE product = " . $fetch['product_id']);
        $car= $produc->fetchAll(PDO::FETCH_ASSOC);
        foreach ($car as $fet) {
        ?>
        <span><?= $fetch['product_name']; ?>(<?= $fetch_cart['quantity']; ?>)</span>
        <?php
      }
    }
    }
  } else {
    echo "<div class='display-order'><span>your cart is empty!</span></div>";
  }
  ?>
  <span class="grand-total">Total: Rs.<?= $totalPrice; ?>/- </span>
</div>

<div class="checkout-form">
        <h2 style="color:black;">Checkout Form</h2>
        <form action="" method="post">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="phone" id="phone" name="phone" required>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" id="address" name="address" required>
            </div>
            <div class="form-group">
                <label for="city">City</label>
                <input type="text" id="city" name="city" required>
            </div>
            <div class="form-group">
                <label for="zip">ZIP Code</label>
                <input type="text" id="zip" name="zip" required>
            </div>
            <div class="form-group">
                <label for="country">Country</label>
                <input type="text" id="country" name="country" required>
            </div>
            <div class="form-group">
                <label for="country">price</label>
                <input readonly type="text" id="price" name="price" value="<?php echo $totalPrice ?>" required><br>
            </div>
            <div class="form-group">

            <div class="form-group">
                <label for="payment">Payment Method</label>
                <select id="payment" name="payment" required>
                    <option value="" disabled selected>Select Payment Method</option>
                    <option value="Cash">Cash on Delivery</option>
                    <option value="E-sewa" disabled>E-sewa(not available)</option>
                </select>
            </div>
            
            <button type="submit" name="submit">Place Order</button>
            
        </form>
        
    </div>
    </div>
</body>
<?php
}

if (isset($_GET['y']) && isset($_GET['t'])) {
    $totalPrice = $_GET['y'];
    $product = $_GET['t'];
    // $totalQuantity = $_GET['w'];
    
    // Check if the form has been submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $_SESSION['cart'] = array();
    }
    
    function saveOrder($conn, $order_data)
    {
        try {
            $sql = "INSERT INTO orders (name, email, phone, address, city, zip, country, payment_method, total_price, order_date,user_id,total_product)
                    VALUES (:name, :email, :phone, :address, :city, :zip, :country, :payment_method, :total_price, :order_date,:user_id,:total_product)";
    
            $stmt = $conn->prepare($sql);
    
            $stmt->bindParam(':name', $order_data['name']);
            $stmt->bindParam(':email', $order_data['email']);
            $stmt->bindParam(':phone', $order_data['phone']);
            $stmt->bindParam(':address', $order_data['address']);
            $stmt->bindParam(':city', $order_data['city']);
            $stmt->bindParam(':zip', $order_data['zip']);
            $stmt->bindParam(':country', $order_data['country']);
            $stmt->bindParam(':payment_method', $order_data['payment_method']);
            $stmt->bindParam(':total_price', $order_data['total_price']);
            $stmt->bindParam(':user_id', $order_data['user_id']);
            $stmt->bindParam(':total_product', $order_data['total_product']);
    
    
            $order_date = date('Y-m-d');
            $stmt->bindParam(':order_date', $order_date);
    
            if ($stmt->execute()) {
                // Redirect to a "Thank You" or order confirmation page
                header('Location: myorder.php');
                exit();
            } else {
                echo "Error saving order.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    
    
    // Check if the form has been submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Get the form data
        $name = $_POST['name'];
        $user = $_SESSION['id'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $zip = $_POST['zip'];
        $country = $_POST['country'];
        $payment_method = $_POST['payment'];
        $total_price = $_POST['price'];; // Initialize total price variable
    
       
            $producte = $conn->query("SELECT * FROM products WHERE product_id = " . $product);
            // a
         foreach($producte as $p){
        
        $total_product = $p['product_name'];
    
        
    
    
        // Get the cart products from the session
        // $cart_products = $_SESSION['cart_products'];
    
        // // Calculate the total price
        // foreach ($cart_products as $product) {
        //     $quantity = isset($product['quantity']) ? $product['quantity'] : 1;
        //     $totalPriceItem = $product['price'] * $quantity;
        //     $total_price += $totalPriceItem;
        // }
    
        // Prepare the data to be saved in the database
        $order_data = array(
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'address' => $address,
            'city' => $city,
            'zip' => $zip,
            'country' => $country,
            'payment_method' => $payment_method,
            'user_id' => $user,
            'total_price' => $total_price,
            'total_product' => $total_product
        );
    
        // Save the order details in the database
        saveOrder($conn, $order_data);
    }
}
    ?>
    
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Checkout</title>
        <link rel="stylesheet" href="css/checkout.css">
    </head>
    <body>
   
    <div class="display-order">
  <?php

      $producte = $conn->query("SELECT * FROM products WHERE product_id = " . $product);
      $cartes = $producte->fetchAll(PDO::FETCH_ASSOC);
      foreach ($cartes as $fetch) {
        ?>
        <span><?= $fetch['product_name']; ?></span>
        <?php
      }
  ?>
  <span class="grand-total"> grand total : $<?= $totalPrice; ?>/- </span>
</div>
    
    <div class="checkout-form">
            <h2 style="color:black;">Checkout Form</h2>
            <form action="" method="post">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="phone" id="phone" name="phone" required>
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" id="address" name="address" required>
                </div>
                <div class="form-group">
                    <label for="city">City</label>
                    <input type="text" id="city" name="city" required>
                </div>
                <div class="form-group">
                    <label for="zip">ZIP Code</label>
                    <input type="text" id="zip" name="zip" required>
                </div>
                <div class="form-group">
                    <label for="country">Country</label>
                    <input type="text" id="country" name="country" required>
                </div>
                <div class="form-group">
                    <label for="country">price</label>
                    <input type="text" id="price" name="price" value="<?php echo $totalPrice ?>" required><br>
                </div>
                <div class="form-group">
    
                <div class="form-group">
                    <label for="payment">Payment Method</label>
                    <select id="payment" name="payment" required>
                        <option value="" disabled selected>Select Payment Method</option>
                        <option value="Cash">Cash on Delivery</option>
                        <option value="E-sewa" disabled>E-sewa(not available)</option>
                    </select>
                </div>
                
                <button type="submit" name="submit">Place Order</button>
                
            </form>
            
        </div>
    </div>
    </body>
    
    <?php
    }
include 'footer.php';
?>
