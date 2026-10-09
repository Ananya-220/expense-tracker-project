<?php 
include ('header.php');
if (isset($_POST['login'])) 
    {
        $username = get_safe_value($_POST['username']);
        $password = get_safe_value($_POST['password']);

        $res = mysqli_query($con , "SELECT * FROM users WHERE username = '$username' AND password = '$password'");

        if (mysqli_num_rows($res)) 
            {
                $row = mysqli_fetch_assoc($res);
                $_SESSION['UID'] = $row['id'];
                $_SESSION['UNAME'] = $row['username'];
                redirect('dashboard.php');
            }
        else 
            {
                echo "Please enter valid login details !";
            }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense Tracker Project</title>
</head>
<body>
    <h2>Login</h2>
    <form method="post">
        <table>
            <tr>
                <td>Username</td>
                <td><input type="text" name="username" required></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input type="password" name="password" required></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="login" value="Login"></td>
            </tr>
        </table>
    </form>
</body>
</html>


<?php 
include ('footer.php');
?>