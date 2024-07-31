<?php
include 'database.php';
?>
  <?php  if (isset($_SESSION['aid'])) {?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="css/adminpanel.css">
</head>
<body>
  <div class="side-menu">
    <div class="brand-name">
      <h1>Evolve Electronics</h1>
    </div><br>
      <a href=""><img src="image/aa.png" alt="">&nbsp; <span>Dashboard</span></a >
      <a href="category.php"><img src="image/ab.png" alt="">&nbsp; <span>Category</span></a >
      <a href="viewproduct.php"><img src="image/ac.png" alt="">&nbsp; <span>View Products</span></a >
      <a href="addproduct.php"><img src="image/ad.png" alt="">&nbsp; <span>Add products</span></a >
      <a href="orders.php"><img src="image/ae.png" alt="">&nbsp; <span>Orders</span></a >
  </div>
  <div class="container">
    <div class="header">
      <div class="nav">
        <div class="user">
          <?php
        if (isset($_SESSION['aid'])) {
			
	    echo $_SESSION['loggedin'];
		
	        echo '<a href="logout.php"><img src="image/logout.png" alt="Image Description"></a>';
	 }
         else {
	        echo '<a  href="login.php">log in</a>';
        }
        ?>
            
        </div>
        </div>
      </div>
    </div>
  </div>
      <?php
      }
      else{
        echo '<script>window.location.href="login.php"</script>';
      }?>
