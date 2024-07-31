<?php
include 'database.php';

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    $stmt= $conn->query("DELETE FROM cart WHERE order_id = ".$product_id."");
}

header('Location: cart.php');
exit();
?>
