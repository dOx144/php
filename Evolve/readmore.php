<?php include 'header.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Item Details</title>
    <link rel="stylesheet" href="css/readmore.css">
</head>
<body>
    <div class="container" >
        <?php
        if (isset($_GET['read'])) {
            $product_id = $_GET['read'];
        
            $itemList = $conn->query("SELECT * FROM products WHERE product_id = ".$_GET['read']."");
        
            foreach ($itemList as $item) {
                echo '<div class="item-details" data-id="' . $item['product_id'] . '">';
                echo '<img src="uploaded_img/'.$item['product_image'].'" alt="' . $item['product_name'] . '">';
                echo '<div class="item-content">';
                echo '<h2>' . $item['product_name'] . '</h2>';
                echo '<p>Price: Rs.' . $item['price'] . '</p>';
               
                $categories = $conn->query("SELECT * FROM category WHERE category_id=".$item['category']."");
                foreach ($categories as $category) {
                    echo '<a class="category-link" href="shop.php?category=' . $category['category_id'] . '">Category: ' . $category['name'] . '</a>';
                }
             
                echo '<div class="description">' . $item['description'] . '</div>';
                echo '<button class="read-more-button" onclick="toggleDescription(' . $item['product_id'] . ')">&nbsp;Read More</button>';
                echo '<div class="buttons">';
                echo '<button class="add-to-cart-button"><a  href="cart.php?cart=' . $item['product_id'] . '">Add to Cart</a></button>';
                echo '<button class="buy-now-button"><a href="checkout.php?t=' . $item['product_id'] . '&y=' . $item['price'] . '">Buy Now</a></button>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
        }
        ?>
    </div>

    <script>
        function toggleDescription(itemId) {
            var description = document.querySelector(`[data-id="${itemId}"] .description`);
            var button = document.querySelector(`[data-id="${itemId}"] .read-more-button`);

            if (description.style.display === "none") {
                description.style.display = "block";
                button.innerText = "Read Less";
            } else {
                description.style.display = "none";
                button.innerText = "Read More";
            }
        }
    </script>
</body>
<?php include 'footer.php'; ?>
</html>
 