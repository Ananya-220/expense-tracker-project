<?php 
include ('header.php');
checkUser();

if (!isset($con) || !$con) {
    $con = mysqli_connect('localhost', 'root', '', 'expense_tracker');
    if (!$con) {
        die('Database connection failed: ' . mysqli_connect_error());
    }
}

$msg = "";
$category = "";
$label = "Add";

if (isset($_GET['id']) && $_GET['id'] > 0)
    {
        $label = "Edit";
        $id = get_safe_value($_GET['id']);
        $res = mysqli_query($con , "SELECT * FROM category WHERE id = '$id'"); 
        $row = mysqli_fetch_assoc($res);
        $category = $row['name'];
    }

if (isset($_POST['submit'])) 
    {
        $name = get_safe_value($_POST['name']);
        $id = get_safe_value($_GET['id']);
        $type = "add";
        $sub_sql = "";
        
        if (isset($_GET['id']) && $_GET['id'] > 0)
            {
                $type = "edit";
                $sub_sql = " AND id != '$id'";
            }

        $res = mysqli_query($con , "SELECT * FROM category WHERE name = '$name' '$sub_sql'"); 

        if (mysqli_num_rows($res) > 0)
            {
                $msg = "Category Already Exists !";
            }
        else 
            {
                $sql = "INSERT INTO category(name) VALUES('$name')";    
                if (isset($_GET['id']) && $_GET['id'] > 0)
                    {
                        $sql = "UPDATE category SET name = '$name' WHERE id = '$id'";
                    }
                mysqli_query($con , $sql);
                redirect('category.php');
            }
    }
include ('user_header.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense Tracker Project</title>
</head>
<body>
    <h2><?php echo $label; ?> Category</h2>
    <a href="category.php">Back</a><br><br>
    <form method="post">
        <table>
            <tr>
                <td>Category</td>
                <td><input type="text" name="name" required value="<?php echo $category; ?>"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="submit" value="Submit"></td>
            </tr>
        </table>
    </form>
    
</body>
</html>

<?php
echo "<br><br>" . $msg;
?>

<?php 
include ('footer.php');
?>