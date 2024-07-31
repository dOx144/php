<?php
include 'adminpanel.php';
?>

<div class="main">
    <div class="containers">
        <a href="viewproduct.php" class="head">Back</a>

        <h1 class="head">Add Product</h1>
        <form action="#" method="POST" enctype="multipart/form-data">
            <div class="form-groups">
                <label for="name">Product Name</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-groups">
                <label for="category">Category:</label>
                <?php
                $dele = $conn->query("SELECT * FROM category");
                ?>
                <select id="category" name="category" required>
                    <?php
                    foreach ($dele as $category) {
                        echo '<option value="' . $category['name'] . '">' . $category['name'] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="form-groups">
                <label for="Price">Price</label>
                <input type="text" id="Price" name="Price" required>
            </div>
            <div class="form-groups">
            <label for="Details">Details</label>
                <textarea id="Details" name="description" rows="4" required></textarea>
            </div>
            <div class="form-groups">
                <label for="product_image">Product Image</label>
                <input type="file" accept="image/png, image/jpeg, image/jpg" name="product_image" required>
            </div>
            <div class="form-groups">
                <button type="submit" name="submit">Send</button>
            </div>
        </form>
    </div>
</div>

<?php
if (isset($_POST['submit'])) {
    $productName = $_POST['name'];
    $category = $_POST['category']; 
    $price = $_POST['Price'];
    $details = $_POST['description'];
    $product_image = $_FILES['product_image']['name'];
    $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
    $product_image_folder = 'uploaded_img/' . $product_image;

    $sele = $conn->prepare("SELECT * FROM category WHERE name = :category");
    $const = ['category' => $category];
    $sele->execute($const);
    $ect = $sele->fetch(PDO::FETCH_ASSOC);
    
    if ($ect) {
        $category_id = $ect['category_id'];
        
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($product_image_folder, PATHINFO_EXTENSION));

        $check = getimagesize($product_image_tmp_name);
        if ($check === false) {
            $uploadOk = 0;
            echo '<script>alert("Sorry, the selected file is not an image.")</script>';
        }

        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            $uploadOk = 0;
            echo '<script>alert("Sorry, only JPG, JPEG, PNG, and GIF files are allowed.")</script>';
        }

        if ($uploadOk == 0) {
            echo '<script>alert("Sorry, your file was not uploaded.")</script>';
        } else {

            if (move_uploaded_file($product_image_tmp_name, $product_image_folder)) {
                $addAuction = $conn->query("INSERT INTO `products`(`product_name`, `price`, `description`, `category`, `product_image`) VALUES ('$productName', '$price', '$details', '$category_id', '$product_image')");
                echo '<script>alert("Product added successfully."); window.location.href="viewproduct.php";</script>';
                die();
            } else {
                echo '<script>alert("Sorry, there was an error uploading your file.")</script>';
            }
        }
    } else {
        echo '<script>alert("Selected category does not exist.")</script>';
    }
}
?>
