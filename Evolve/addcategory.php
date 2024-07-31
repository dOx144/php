
 <?php
 include "adminpanel.php";
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category</title>
</head>
<body>
    <main class="moved-main">
    <div class="form-group">
        <h1>Add Category</h1>
        <form action="" method="POST">  
            <label for="category">Category Name:</label>
            <input type="text" id="category" name="category" required>
            <button type="submit" name ="submit">Add Category</button>
        </form>
    </div>
    </main>
</body>
</html>

<?php
if(isset($_POST['submit'])){

$category =$_POST["category"];

$addCat = $conn -> query ("INSERT INTO `category`(`name`) VALUES ('".$category."')"); 
}

?>