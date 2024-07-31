<?php
include 'adminpanel.php'; 

$removeForeignKeyQuery = "ALTER TABLE cart DROP FOREIGN KEY order_prod";
$conn->exec($removeForeignKeyQuery);

$createTmpTableQuery = "CREATE TABLE IF NOT EXISTS tmp_products (id INT AUTO_INCREMENT PRIMARY KEY, product_id_old INT)";
$conn->exec($createTmpTableQuery);

$selectProductIdsQuery = "SELECT product_id FROM products ORDER BY product_id";
$statement = $conn->query($selectProductIdsQuery);
$index = 1;

while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
    $productId = $row['product_id'];
    $insertTmpTableQuery = "INSERT INTO tmp_products (product_id_old) VALUES ($productId)";
    $conn->exec($insertTmpTableQuery);

    $updateProductsTableQuery = "UPDATE products SET product_id = $index WHERE product_id = $productId";
    $conn->exec($updateProductsTableQuery);

    $index++;
}

$addForeignKeyQuery = "ALTER TABLE cart ADD CONSTRAINT order_prod FOREIGN KEY (product) REFERENCES products (product_id)";
$conn->exec($addForeignKeyQuery);

$dropTmpTableQuery = "DROP TABLE tmp_products";
$conn->exec($dropTmpTableQuery);

$productsQuery = "SELECT * FROM products";
$result = $conn->query($productsQuery);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Page</title>  
    <link rel="stylesheet" href="css/viewproduct.css">

</head>

<body>
    <main>

    <div class="product-table">
        <h2 style="color: black;">Product Details</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Details</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)) { ?>
                    <tr>
                        <td><?php echo $row['product_id']; ?></td>
                        <td>
                            <img src="uploaded_img/<?php echo $row['product_image']; ?>" alt="Product Image">
                        </td>
                        <td><?php echo $row['product_name']; ?></td>
                        <td><?php echo $row['price']; ?></td>
                        <?php  $categories = $conn->query("SELECT * FROM category where category_id=".$row['category']."");
                        foreach ($categories as $category) {
                        echo' <td> '. $category['name'].'</td>';
                        }
                        ?>
                        <td><?php echo $row['description']; ?></td>
                        <td><a href='deleteproduct.php?id=<?php echo $row['product_id']; ?>'>Delete</a><br><br>
                        <a href='update_product.php?id=<?php echo $row['product_id']; ?>'>Update</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    </main> 
</body>
</html>
