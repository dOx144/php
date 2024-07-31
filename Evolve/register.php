<?php
include 'database.php';
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        echo 'Passwords do not match.';
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $insert_query = $conn->prepare("INSERT INTO user (username, email, phone, address, city, password) VALUES (:username, :email, :phone, :address, :city, :password)");

        $criteria = [
            'username' => $username,
            'email' => $email,
            'phone' => $phone,
            'address' => $address,
            'city' => $city,
            'password' => $hashed_password
        ];

        if ($insert_query->execute($criteria)) {
            echo '<script>alert("Registration successful! Please login.");window.location.href="evolve.php"</script>';
            die();
        } else {
            echo 'Error occurred. Please try again later.';
        }
    }
}
?>

<head>
  <title>User Registration</title>
  <link rel="stylesheet" type="text/css" href="css/register.css">
</head>
<body>
  <div class="container">
    <h2>User Registration</h2>
    <form action="" method="post">
      <div>
        <label for="name">Name:</label>
        <input type="text" id="username" name="username" required>
      </div>
      <div>
        <label for="email">Email:</label>
        <input type="text" id="email" name="email" required>
      </div>
      <div>
        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone" required>
      </div>
      <div>
        <label for="address">Street Address:</label>
        <input type="text" id="address" name="address" required>
      </div>
      <div>
        <label for="city">City:</label>
        <input type="text" id="city" name="city" required>
      </div>
      
      <div>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
      </div>
      <div>
        <label for="confirm_password">Confirm Password:</label>
        <input type="password" id="confirm_password" name="confirm_password" required>
      </div>
      <div>
        <input type="submit" name="submit" value="Register">
      </div>
    </form>
  </div>
</body>
</html>
