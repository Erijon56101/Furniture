<?php   
@include 'config.php';
$query = "SELECT * FROM user_form WHERE user_type = 'user'";
$run = mysqli_query($conn, $query);
?>  
<!DOCTYPE html>  
<html>  
<head>  
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="images/sofa.png" type="image/x-icon">
   <title>Dashboard</title>
    <link rel="stylesheet" href="css/Dashboard1.css" />
</head>  
<body>  
    <div class="container">
        <header></header>  
        <table border="1" cellspacing="0" cellpadding="0">  
            <tr class="table-heading"> 
                <th>ID</th>  
                <th>Name</th>  
                <th>Email</th>  
                <th>Roli</th> 
                <th>Action</th>
            </tr>  
            <?php   
            $i=1;  
            if ($num = mysqli_num_rows($run) > 0) {  
                while ($result = mysqli_fetch_assoc($run)) {  
                    echo "  
                        <tr class='table-data'>  
                            <td>".$i++."</td>   
                            <td>".$result['name']."</td>  
                            <td>".$result['email']."</td>  
                            <td>".$result['user_type']."</td>  
                            <td>
                                <a href='delete.php?name=".$result['name']."' class='btn-delete'>Delete</a>
                                <a href='edit.php?id=".$result['id']."' class='btn-edit'>Edit</a>
                            </td>
                        </tr>  
                    ";  
                }  
            }  
            ?>  
        </table>  
    </body>  
    </html>
