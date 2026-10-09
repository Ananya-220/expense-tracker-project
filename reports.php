<?php 
include ('header.php');
checkUser();
include ('user_header.php');
$cat_id = '';
$sub_sql = '';
$from = '';
$to = '';
if (isset($_GET['category_id']) && (int)$_GET['category_id'] > 0)
    {
        $cat_id = get_safe_value($_GET['category_id']);
        $sub_sql .= " AND category.id = $cat_id";
    }
if (isset($_GET['from']))
    {
        $from = get_safe_value($_GET['from']);   
    }
if (isset($_GET['to']))
    {
        $to = get_safe_value($_GET['to']);
    }
if ($from != '' && $to != '')
    {
        $sub_sql .= " AND expense.expense_date BETWEEN '$from' AND '$to'";
    }

$res = mysqli_query($con , "SELECT category.name , SUM(expense.price) AS price FROM expense JOIN category ON expense.category_id = category.id $sub_sql GROUP BY category.id , category.name");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense Tracker Project</title>
</head>
<body>
    <h2>Reports</h2>
    <form method="get">
        From : <input type="date" name="from" value="<?php echo $from; ?>">
        &nbsp;&nbsp;&nbsp; 
        To : <input type="date" name="to" value="<?php echo $to; ?>">
        &nbsp;&nbsp;&nbsp; 
        <?php echo getCategory($cat_id , 'reports'); ?>
        &nbsp;&nbsp;&nbsp;  
        <input type="submit" name="submit" value="Submit">
        <a href="reports.php">Reset</a><br><br>
        <br><br>
    </form>
    <br><br>
    <?php 
        if (mysqli_num_rows($res) > 0) 
            {
    ?>
    <table border="1">
        <tr>
            <th>Category</th>
            <th>Price</th>
        </tr>
        <?php
            $final_price = 0;
            while ($row = mysqli_fetch_assoc($res)) 
                {
                    $final_price = $final_price + $row['price'];
        ?>
        <tr>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['price']; ?></td>
        </tr>
        <?php
                }
        ?>
        <tr>
            <th>Total</th>
            <th><?php echo $final_price; ?></th>
        </tr>
    </table>
    <?php 
            }
            else {
                echo "No data found !";
            }
    ?>
</body>
</html>


<?php 
include ('footer.php');
?>