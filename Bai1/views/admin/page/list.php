<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/".'php/AHT/Bai1/views/admin/layout/header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="./css/styleAdmin.css">  -->
    <link rel="stylesheet" href="./css/styleList.css"> 
    <title>Thêm Account</title>
</head>
<body>
    <center><h4>List Account</h4></center>
    <div class="table">
    <div class="container-fluid">
    <a class="add" href="?action=add">Add</a>
        <table class = "table-bordered" border="1px">
            <tr>
                <th >STT</th>
                <th>Name</th>
                <th>Email</th>
                <th>Created-Date</th>
                <th >Updated-Date</th> 
                <th>Update</th>
            </tr>

            <?php
                    $i = 0;
                    // Hiển thị thông tin sinh viên ra tabel
                    foreach($results as $data){
                        echo '<tr>
                                <td class="stt">'.$i++.'</td>
                                <td>'.$data['name'].'</td>
                                <td>'.$data['email'].'</td>  
                                <td>'.$data['created_date'].'</td>
                                <td>'.$data['updated_date'].'</td>
                                <td class="update"><a class="edit" href="?id='.$data['id'].'&action=edit">Edit</a><a class="delete" href="?id='.$data['id'].'&action=delete">Delete</a></td>
                            </tr>';
                    }
                ?>
           
        </table>
    </div>
    </div>
    
</body>
</html>