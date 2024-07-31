<?php
include 'header.php';

if (isset($_GET['cart'])) {
    $product_id = $_GET['cart'];
    
    $user_id = $_SESSION['id'];

    $insert_query = $conn->prepare("INSERT INTO cart (product, customer) VALUES ( :product,:customer)");
    $insert_query->execute(['product' => $product_id, 'customer' => $user_id]);

    exit(); 
}
?>

<title>Shop</title>
<link rel="stylesheet" href="css/shop.css">
</head>
<body>
    <div>
        <?php if (isset($_GET['category'])) {

            $sele = $conn->query("SELECT * FROM products where category = " . $_GET['category'] . "");
            $sm = $conn->query("SELECT * FROM category where category_id = " . $_GET['category'] . "");

            foreach ($sm as $ca) {
        ?>

                <h2 style="background-color: #3d3939; padding: 20px;"><?php echo $ca['name'] ?></h2>
        <?php
            }
        ?>
        <div class="flex-container">
            <?php if (!empty($sele)) {
                foreach ($sele as $pele) {
            ?>
                    <div>
                        <img src="uploaded_img/<?php echo $pele['product_image']; ?>" alt="monitor" class="pro"><hr>
                        <h4><?php echo $pele['product_name']; ?></h4>
                        <p>Price: Rs.<?php echo $pele['price']; ?></p>
                        <?php if (isset($_SESSION['id']) && $_SESSION['loggedin']) { ?>
                            <button><a href="cart.php?cart=<?php echo $pele['product_id']; ?>">Add to Cart</a></button>
                        <?php } ?>
                        <button><a href="readmore.php?read=<?php echo $pele['product_id']; ?>">Read More</a></button>
                    </div>
            <?php }
            } else {
                echo 'No products found.';
            }
        } ?>
        </div>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>
