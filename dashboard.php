<?php 
include ('header.php');
checkUser();
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
    <h2>Dashboard</h2>
    <table>
        <tr>
            <td>Today's Expense</td>
            <td></td>
        </tr>
        <tr>
            <td>Yesterday's Expense</td>
            <td></td>
        </tr>
        <tr>
            <td>This Week's Expense</td>
            <td></td>
        </tr>
        <tr>
            <td>This Months's Expense</td>
            <td></td>
        </tr>
        <tr>
            <td>This Year's Expense</td>
            <td></td>
        </tr>
        <tr>
            <td>Total Expense</td>
            <td></td>
        </tr>
    </table>
</body>
</html>


<?php 
include ('footer.php');
?>