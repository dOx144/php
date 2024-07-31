<title>My Cart</title>
<?php
include 'header.php';

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}
if (isset($_POST['update_update_btn'])) {
    $update_value = $_POST['update_quantity'];
    $update_id = $_POST['update_quantity_id'];
    
    $update_query = $conn->prepare("UPDATE cart SET quantity = :quantity WHERE order_id = :order_id");
    $update_query->bindParam(':quantity', $update_value, PDO::PARAM_INT);
    $update_query->bindParam(':order_id', $update_id, PDO::PARAM_INT); 

    if ($update_query->execute()) {
        header('location: cart.php');
    }
}

if (isset($_GET['cart'])) {
    $product_id = $_GET['cart'];
    
    // Checking if the product is already in the cart
    if (!in_array($product_id, $_SESSION['cart'])) {
        $_SESSION['cart'][] = $product_id;
        
        $user_id = $_SESSION['id']; 

        // Insert the selected product into the cart table
        $insert_query = $conn->prepare("INSERT INTO cart (product, customer) VALUES (:product, :customer)");
        $insert_query->execute(['product' => $product_id, 'customer' => $user_id]);
    }
    else {
        // Updating the quantity if the product is already there
        $update_query = $conn->prepare("UPDATE cart SET quantity = quantity + 1 WHERE product = :product_id");
        $update_query->bindParam(':product_id', $product_id, PDO::PARAM_INT);
    
        if ($update_query->execute()) {
            header('location: cart.php');
        }
    }
    
}

// Retrieve cart items from the database based on the product IDs stored in the session
$cart_items = array();
if (!empty($_SESSION['cart'])) {
    $in_clause = implode(",", $_SESSION['cart']);
    $product_query = $conn->query("SELECT * FROM cart");
    $cart_items = $product_query->fetchAll(PDO::FETCH_ASSOC);
}

$totalPrice = 0; // Initialize total price variable
?>

<main>
    <div class="product-table">
        <h2 style="color: black;">My Cart</h2>
        <form method="post" action="cart.php">
            <table>
                <thead>
                    <tr>
                        <th>Product ID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Updated Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($cart_items as $cart_item) {
                        $product_query = $conn->query("SELECT * FROM products WHERE product_id = " . $cart_item['product']);
                        $product_data = $product_query->fetch(PDO::FETCH_ASSOC);
                        $updatedPrice = $product_data['price'] * (($cart_item['quantity'] > 0) ? $cart_item['quantity'] : 1);

                        $totalPrice += $updatedPrice;
                        ?>
                        <tr>
                            <td><?php echo $product_data['product_id']; ?></td>

                            <td><img src="uploaded_img/<?php echo $product_data['product_image']; ?>" alt="Product Image"></td>

                            <td><?php echo $product_data['product_name']; ?></td>

                            <td>
                                <?php
                                    $category_query = $conn->query("SELECT * FROM category WHERE category_id = " . $product_data['category']);
                                    $category_data = $category_query->fetch(PDO::FETCH_ASSOC);
                                    echo $category_data['name'];
                                ?>
                            </td>

                            <td>$<?php echo $product_data['price']; ?></td>

                            <td>
                                <form action="" method="post">
                                    <input type="hidden" name="update_quantity_id" value="<?php echo $cart_item['order_id']; ?>">
                                    <input type="number" name="update_quantity" min="1" value="<?php echo ($cart_item['quantity'] > 0) ? $cart_item['quantity'] : 1; ?>">
                                    <input type="submit" value="Update" name="update_update_btn">
                                </form>
                            </td>

                            <td>Rs.<?php echo $product_data['price'] * (($cart_item['quantity'] > 0) ? $cart_item['quantity'] : 1); ?></td>
                            
                            <td>
                                <a href='deletecart.php?id=<?php echo $cart_item['order_id']; ?>'>Delete</a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </form>
        <div class="total-price">
            Total Price: Rs.<?php echo $totalPrice; ?>
        </div>  

        <a href="checkout.php?q=<?php echo $totalPrice ?>" class="check">Checkout</a>
    </div>
</main>

<?php include 'footer.php'; ?>
