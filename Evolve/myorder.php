<?php
include 'header.php';
try {
  
    $user_id = $_SESSION['id'];
    
    $stmt = $conn->prepare("SELECT * FROM orders WHERE user_id = :user_id");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    die();
}
if (isset($_SESSION['id']) && $_SESSION['loggedin']){

?>
<link rel="stylesheet" href="css/myorder.css">
<main>
    <div class="order-table">
        <h2 style="color: black;">My Orders</h2>
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Total Products</th>
                    <th>Total Price</th>
                    <th>Order Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?php echo $order['order_id']; ?></td>
                        <td><?php echo $order['name']; ?></td>
                        <td><?php echo $order['email']; ?></td>
                        <td><?php echo $order['total_product']; ?></td>
                        <td>Rs.<?php echo number_format($order['total_price']); ?></td>
                        <td><?php echo $order['order_date']; ?></td>
                        <td><?php echo $order['order_status']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>

<?php 
} else{
header('Location: login.php');
exit();
}
include 'footer.php'; ?>
