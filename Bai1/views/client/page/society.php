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
            <div class="content-home">
                <div class="menu-content">
                <div class="silde">
                            <?php
                                foreach($list2 as $dataa){
                                    echo '<div class="slide_show">
                                            <a href="?id='.$dataa['id'].'&action=detail"><img src="'.$dataa['img'].'" alt="" style="width:100%;  height: 500px;position: relative"></a>
                                            
                                        </div>';
                                }
                            ?>
                            <!-- <div class="content-slide_left">
                                                <h3>'.$dataa['name'].'</h3>
                                            </div> -->
                           
                        </div>
                  
                </div>
                
                <div class="title-tintuc">
                    <?php
                    $id = $_GET['id'];
                     foreach($tam as $data){
                         if($data['id'] == $id){
                            echo '<h3>TIN TỨC '.$data['name'].'</h3>';
                            break;
                         }
                        
                    }
                    ?>
                    
                </div>
                <div class="tin-tuc">
                    <div>
                        <?php
                            foreach($list as $data){
                                // var_dump($temp);
                                echo '<div class="newspage">
                                        <div class="img">
                                            <a href="?id='.$data['id'].'&action=detail"><img src="'.$data['img'].'" alt=""></a>  
                                        </div>
                                        <div class="content">
                                            <h3><a href="?id='.$data['id'].'&action=detail">'.$data['name'].'</a></h3>
                                            <div class="create">
                                                <a href="?id='.$data['id'].'&action=detail">'.$data['CreateBy'].'</a>
                                                <div  class="create-date" >
                                                    <i class="far fa-clock"></i>
                                                    <a href="?id='.$data['id'].'&action=detail">'.$data['CreateDate'].'</a>
                                                </div>
                                                
                                            </div>
                                            
                                        </div>
                                       
                                        
                                      
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
        setTimeout(showSlide, 2500);
    }
</script>

<?php
    require_once $_SERVER["DOCUMENT_ROOT"]."/"."php/AHT/Bai1/views/client/layout/footer.php";
?>