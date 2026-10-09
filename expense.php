<?php 
include ('header.php');
checkUser();
include ('user_header.php');

if (isset($_GET['type']) && $_GET['type'] == "delete" && isset($_GET['id']) && $_GET['id'] > 0)
    {
        $id = get_safe_value($_GET['id']);
        mysqli_query($con , "DELETE FROM expense WHERE id = '$id'");
        echo "<br> Data Deleted Succesfully ! <br>";
    }

$res = mysqli_query($con , "SELECT expense.* , category.name FROM expense , category WHERE expense.category_id = category.id ORDER BY expense.id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense Tracker Project</title>
</head>
<body>
    <h2>Expense</h2>
    <a href="manage_expense.php">Add Expense</a><br><br>
    <?php
        if (mysqli_num_rows($res) > 0) 
            {
    ?>
    <table border="1">
        <tr>
            <td>ID</td>
            <td>Category</td>
            <td>Item</td>
            <td>Price</td>
            <td>Details</td>
            <td>Date</td>
            <td>Action</td>
        </tr>
        <?php
            while ($row = mysqli_fetch_assoc($res)) 
                {
        ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['item']; ?></td>
            <td><?php echo $row['price']; ?></td>
            <td><?php echo $row['details']; ?></td>
            <td><?php echo $row['added_on']; ?></td>
            <td>
                <a href="manage_expense.php?id=<?php echo $row['id']; ?>">Edit</a>&nbsp;
                <a href="?type=delete&id=<?php echo $row['id']; ?>">Delete</a>
            </td>
        </tr>
        <?php
                }
        ?>
    </table>
    <?php 
            }
        else 
            {
                echo "No Data Found !";
            }
                
    ?>
</body>
</html>


<?php 
include ('footer.php');
?>