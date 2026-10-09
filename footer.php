<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=], initial-scale=1.0">
    <title>Footer</title>
</head>
<body>
    <div>
        <br><br>
        @copyright
        <?php
            echo date('Y');
        ?>
    </div>

    <script>
        function change_cat()
            {
               var category_id = document.getElementById('category_id').value;
               window.location.href = 'reports.php?category_id=' + category_id;
            }
    </script>
</body>
</html>