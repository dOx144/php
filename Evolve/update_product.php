<?php
include 'adminpanel.php';
?>

<h1>Update Product</h1>
<?php
$su = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM products WHERE product_id = :product_id");
$stmt->execute(['product_id' => $su]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    echo 'Product not found.';
} else {
    // Fetch categories from the database
    $categoriesQuery = $conn->query("SELECT * FROM category");
    $categories = $categoriesQuery->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <form action="" class="update" method="POST" enctype="multipart/form-data">
        <p>Update Product</p>
        <input type="hidden" name="id" value="<?php echo $product['product_id']; ?>">
        <label for="name">Product Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $product['product_name']; ?>" required><br>
        <label for="category">Category:</label>
        <select id="category" name="category" required>
            <?php foreach ($categories as $category) { ?>
                <option value="<?php echo $category['category_id']; ?>"
                    <?php if ($category['category_id'] == $product['category']) { echo 'selected'; } ?>>
                    <?php echo $category['name']; ?>
                </option>
            <?php } ?>
        </select><br>
        <label for="Price">Price:</label>
        <input type="text" id="Price" name="Price" value="<?php echo $product['price']; ?>" required><br>
        <label for="Details">Details:</label>
        <input type="text" id="Details" name="Details" value="<?php echo $product['description']; ?>" required><br>
        <label for="product_image">Product Image:</label>
        <input type="file" accept="image/png, image/jpeg, image/jpg" name="product_image"><br>
        <button type="submit" name="submit">Update Product</button>
    </form>
<?php
}

if (isset($_POST['submit'])) {
    $productId = $_POST["id"];
    $productName = $_POST["name"];
    $category = $_POST["category"];
    $price = $_POST["Price"];
    $details = $_POST["Details"];

    if ($_FILES['product_image']['error'] === UPLOAD_ERR_OK) {
        $product_image = $_FILES['product_image']['name'];
        $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
        $product_image_folder = 'uploaded_img/' . $product_image;

        $imageFileType = strtolower(pathinfo($product_image_folder, PATHINFO_EXTENSION));

        $check = getimagesize($product_image_tmp_name);
        if ($check === false) {
            echo '<script>alert("Sorry, the selected file is not an image.")</script>';
            exit();
        } elseif (!in_array($imageFileType, array("jpg", "jpeg", "png", "gif"))) {
            echo '<script>alert("Sorry, only JPG, JPEG, PNG, and GIF files are allowed.")</script>';
            exit();
        } elseif (!move_uploaded_file($product_image_tmp_name, $product_image_folder)) {
            echo '<script>alert("Sorry, there was an error uploading your file.")</script>';
            exit();
        }
    } else {
        $product_image = $product['product_image'];
    }

    $stmt = $conn->prepare("UPDATE products SET product_name = :productName, category = :category, price = :price, description = :details, product_image = :productImage WHERE product_id = :productId");
    $stmt->execute([
        'productName' => $productName,
        'category' => $category,
        'price' => $price,
        'details' => $details,
        'productImage' => $product_image,
        'productId' => $productId
    ]);

    echo '<script>window.location.href="viewproduct.php"</script>';
    exit();
}
?>
