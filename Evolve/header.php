<?php
include 'database.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/evolve.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div class="top" style="background-color: red;">
        Contact: +977-9812345670
        <div style="float:right; padding-right: 20px;"> 
        Mail at: rashikmoktan@gmail.com</div>
    </div>

    <div style="background-color: black; color:white; padding: 10px;">   
        <ul class="navbar">
            <li>
                <a href="evolve.php" style="color: white;">HOME</a>
            </li>
            <li>
            <div class="dropdown">
                    <a>SHOP</a>
                    <div class="dropdown-content">
                        <?php
                        $categories = $conn->query("SELECT * FROM category");
                        foreach ($categories as $category) {
                            echo '<a href="shop.php?category=' . $category['category_id'] . '">' . $category['name'] . '</a>';
                        }
                        ?>
                    </div>
            </div>
            </li>
            <li>
                <a href="aboutus.php" style="color: white;">ABOUT US</a>
            </li>
            <li>
            <li class="profile">
    <div class="dropdown">
        <img src="image/profile.png" alt="Profile Image" class="profile-image">
        <div class="dropdown-content">
        <?php
                if (isset($_SESSION['id'])) {
                    echo $_SESSION['loggedin'];
                    echo'<a href="cart.php">My Cart</a>
                    <a href="myorder.php">My Order</a>
                     <a href="logout.php">Logout</a>';
                } else {
                    echo '<a  href="login.php">log in</a>';
                }
                ?>
            
        </div>
    </div>
</li>

            </li>
        </ul>
        <h1>Evolve Electronics</h1>
    </div>

</body>
</html>
