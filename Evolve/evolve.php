<title>Evolve Electronics</title>
<?php
  include 'header.php'
?>

    <div class="image">
                <p style="font-size: 60px;">Electronic Collection<p><br>
                <p style="font-size: 35px;">20% Off Till September<p><br>
                <p style="font-size: 35px;">A leading company in the field of Electronics.<p><br>
                <p style="font-size: 35px;">30-Day return or refund guarantee<p><br>
    </div>

    <div>
        <h1 style="background-color: #3d3939; color: white; text-align: center; font-size: 40px; padding: 15px;">Our Latest Products</h1>

        <div class="flex-container">
        <?php
        $product_query = $conn->query("SELECT * FROM products ORDER BY product_id DESC LIMIT 6");
        $latest_products = $product_query->fetchAll(PDO::FETCH_ASSOC);

        foreach ($latest_products as $product) {
            echo '<div class="product">';
            echo '<img src="uploaded_img/'.$product['product_image'].'" alt="' . $product['product_name'] . '" class="pro"><hr>';
            echo '<h4>' . $product['product_name'] . '</h4>';
            echo '<button><a href="readmore.php?read=' . $product['product_id'] . '">Read More</a></button>';
            echo '</div>';
        }
        ?>
    </div>
</div>



    <div class="para">
        <h1>Evolve Electronics</h1>
    <p>       
          <i>
            Evolve Electronics is the leading online electronics marketplace in Nepal, currently listing tens of thousands of electronics product for sale all over Kathmandu, Pokhara and rest the country.
            If you are looking to buy any electronics items from any part of Nepal, you can find them all on our website. <br>
            We pride ourselves on our commitment to customer satisfaction and our competitive pricing. Evolve Electronics is your ultimate online destination for all things electronic. We offer a wide range of high-quality gadgets and devices, from smartphones to laptops, that cater to both tech enthusiasts and everyday users. Our user-friendly website makes shopping a breeze, with detailed product info and easy checkout. We're dedicated to providing top-notch customer service, ensuring a smooth experience from start to delivery. <br>Embrace the future of tech shopping with Evolve Electronics!
          </i>
        </p>
    </div>
   

</body>
<?php
  include 'footer.php'
?>
</html>