<?php
    require_once $_SERVER["DOCUMENT_ROOT"]."/"."php/AHT/Bai1/views/client/layout/header.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./views/client/css/styleHome.css">
    <title>Document</title>
</head>
<body>
    <div class="page-detail">
        <div class="content">
            <?php       
             // var_dump($temp['introduce']);
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