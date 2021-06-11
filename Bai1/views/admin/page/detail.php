<?php
       require_once $_SERVER["DOCUMENT_ROOT"]."/".'php/AHT/Bai1/views/admin/layout/header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styleHome.css">
    <title>Document</title>
</head>
<body>
    <div class="page-detail">
        <div class="content">
                
           
            <?php 
            $id = $_GET['id'];      
             echo ' <div class="update">
                    <a class="edit" href="?id='.$id.'&action=editBanTin">Sửa Bản Ghi</a>
                    <a class="delete" href="?id='.$id.'&action=xoaBanTin">Xóa Bản Ghi</a>
                </div>';
              $filename = $temp['introduce'];
                $fp = fopen($filename, "r");//mở file ở chế độ đọc
                
                $contents = fread($fp, filesize($filename));//đọc file
                
                echo "<p>$contents</p>";//in nội dung của file ra màn hình
                fclose($fp);//đóng file
            ?>
        </div>
    </div>
</body>
</html>

<?php
    require_once $_SERVER["DOCUMENT_ROOT"]."/"."php/AHT/Bai1/views/client/layout/footer.php";
?>