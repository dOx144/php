<?php
include "adminpanel.php";
?>

<main class="moved-main">
    <h1 style="color: black;">Product Categories</h1>
    <a href="addcategory.php">Add category</a>

    <table>
        <tr>
            <th>Name</th>
            <th>Action</th>
        </tr>

        <?php
        $categories = $conn->query("SELECT * FROM category");

        foreach ($categories as $category) {
            echo "<tr>";
            echo "<td>" . $category['name'] . "</td>";
            echo "<td><a href='deletecategory.php?id=" . $category['category_id'] . "'>Delete</a>
                      <a href='updatecategory.php?id=" . $category['category_id'] . "'>Update</a>
                  </td>"; 
            echo "</tr>";
        }
        ?>
    </table>
</main>
