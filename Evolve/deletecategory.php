<?php
  include 'database.php'
?>

<?php
if (isset($_GET["id"]) && !empty($_GET["id"])) {
    $su = $_GET["id"];

    
    $stmt= $conn->query("DELETE FROM category WHERE category_id = ".$su."");

    if ($stmt->execute()) {
        echo "Product deleted successfully!";
    } else{
        echo'error';
    }
}
    echo '<script>window.location.href="category.php"</script>';
?>
