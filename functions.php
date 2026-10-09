<?php
function prx ($data)
    {
        echo "<pre>";
        print_r($data);
        die();
    }

function get_safe_value ($data) 
    {
        global $con;
        if ($data) 
            {
                return mysqli_real_escape_string($con , $data);
            }
    }

function redirect ($link)
    {
        ?>
            <script>
                window.location.href = "<?php echo $link ?>";
            </script>
        <?php
    }

function checkUser ()
    {
        if (isset($_SESSION['UID']) && $_SESSION['UID'] != "") 
            {
        
            }
        else 
            {
                redirect('index.php');
            }
    }

function getCategory ($category_id = '' , $page = '')
    {
        global $con;
        $res = mysqli_query($con , "SELECT * FROM category ORDER BY name ASC");
        $fun = "required";
        if ($page == "reports")
            {
                // $fun = "onchange = change_cat()";
                $fun = "";
            }

        $html = '<select name = "category_id" id = "category_id">';

            $html .= '<option value = "">Select Category</option>';

            while ($row = mysqli_fetch_assoc($res)) 
                {
                    if ($category_id > 0 && $category_id == $row['id'])    
                        {
                            $html .= '<option value = "' . $row['id'] . '" selected>' . $row['name'] . '</option>';
                        }
                    else 
                        {
                            $html .= '<option value = "' . $row['id'] . '">' . $row['name'] . '</option>';
                        }
                }

        $html .= '</select>';

        return $html;
    }

function getDashboardExpense ($type)
    {
        global $con;
        if ($type == 'today') 
            {
                $sub_str = " WHERE  "
            }
        $res = mysqli_query($con , "SELECT SUM(price) AS price FROM expense");
        $row = mysqli_fetch_assoc($res);

    }
?>