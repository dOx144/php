<?php
include 'adminpanel.php';

if (isset($_POST['complete_btn']) && isset($_POST['order_id'])) {
    try {
        $order_id = $_POST['order_id'];

        $update_sql = "UPDATE orders SET order_status = 'Delivered' WHERE order_id = :order_id";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bindParam(':order_id', $order_id, PDO::PARAM_INT);
        $update_stmt->execute();

        header('Location: orders.php');
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        die();
    }
}
?>
