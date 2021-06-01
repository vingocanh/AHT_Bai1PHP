<?php
    require_once $_SERVER["DOCUMENT_ROOT"]."/"."php/AHT/Bai1/views/client/layout/header.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

   
    <!-- ICon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <!-- ResetCSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w==" crossorigin="anonymous" />
    <!-- Font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="./views/client/css/styleHome.css">
    <title>Page PHP</title>
</head>
<body>
    <div class="page">
      
        <div class="type-content">
            <div class="content">
                <div class="menu-content">
                    <div class="silde">
                        <div class="slide_show">
                            <img src="http://runecom03.runtime.vn/Uploads/shop90/images/product/EOS-5D-MarkIII.jpg" alt=""style="width:100%">
                        </div>
                        <div class="slide_show">
                            <img src="http://runecom03.runtime.vn/Uploads/shop90/images/product/canon-powershot-g7x.jpg" alt=""style="width:100%">
                        </div>
                        <div class="slide_show">
                            <img src="http://runecom03.runtime.vn/Uploads/shop90/images/product/canon-powershot-g1x-mark-ii1.jpg" alt=""style="width:100%">
                        </div>
                    </div>
                    <div class="menu-right">
                    </div>
                </div>
                
                <h3>Tin Nổi bật</h3>
                <div class="tin-tuc">
                    <div>
                        <?php
                            foreach($list as $data){
                                echo '<div class="newspage">
                                        <a href=""><img src="'.$data['img'].'" alt=""></a>
                                        <h3><a href="">'.$data['name'].'</a></h3>
                                    </div>';
                                // echo '<img src="'.$data['img'].'" alt="">';
                            }
                        ?>
                    </div>
                </div>
                
            </div> 
        </div>
        
    
    </div>

</body>
</html>

<script>
    var index = 0;
    showSlide();
    function showSlide(){
        var slide = document.getElementsByClassName('slide_show');
        for(var i = 0; i< slide.length; i++){
            slide[i].style.display="none";
        }
        index++;
        if(index > slide.length){
            index=1;
        }
        slide[index-1].style.display="block";
        setTimeout(showSlide, 2000);
    }
</script>

<?php
    require_once $_SERVER["DOCUMENT_ROOT"]."/"."php/AHT/Bai1/views/client/layout/footer.php";
?>