<?php
  include 'database.php'
?>
    <h1>Update category</h1>
    <?php
        $su = $_GET['id'];
    
            $stmt = $conn->query("SELECT * FROM category WHERE category_id = ".$su."");
            foreach($stmt as $product){
   
       echo' <form action="" method="POST">
            <input type="hidden" name="id" value="'.$product['category_id'].'">
            <label for="name">Product Name:</label>
            <input type="text" id="name" name="name" value="'.$product['name'].'" required><br>
            <button type="submit" name="submit">Update category</button>
        </form>';
        }

if (isset($_POST['submit'])) {
    $categoryName = $_POST["name"];
    
    $sele = $conn->query("UPDATE `category` SET `name`='".$categoryName."' WHERE category_id=".$su."");
    echo '<script>window.location.href="category.php"</script>';

}
?>

