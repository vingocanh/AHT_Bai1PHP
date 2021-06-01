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
    <link rel="stylesheet" href="./views/client/css/styleClient.css">
    <title>PHP</title>
</head>
<body>
    <div class="page">
        <header>
            <div id="menu">
                    <div class="header-top">
                        <div id="header-top">
                            <div class="header-top__left">
                                <div class="phone">
                                    <a href=""><i class="fa fa-phone"></i>0973.733.507</a>
                                </div>
                                
                            </div>
                            <div class="header-top__right">
                                <!-- <div class="cart">
                                    <a href="#"><i class="pe-7s-cart"></i>Giỏ Hàng</a>
                                </div> -->
                                <div class="login">
                                <!-- <?php     
                                    if(SessionUser::getSession("sessionUsers")){
                                        echo '<a href=""><i class="fas fa-sign-in-alt"></i> '.SessionUser::getSession("sessionUsers")['name'].' </a>';
                                    }else{
                                        echo '<a href="?action=login"><i class="fas fa-sign-in-alt"></i>Đăng nhập</a>';
                                    }
                                    
                                ?> -->
                                    <a href="?action=login"><i class="fas fa-sign-in-alt"></i>Đăng Nhập</a>
                                </div>
                                <div class="signout">
                                <!-- <?php
                                    if(SessionUser::getSession("sessionUsers")){
                                        echo '<a href="?action=out"><i class="fas fa-sign-in-alt"></i> Logout </a>';
                                    }else{
                                        echo '<a href="?action=signup"><i class="fas fa-sign-out-alt"></i>Đăng Ký</a>';
                                    }
                                    
                                ?> -->
                                    <a href="?action=signup"><i class="fas fa-sign-out-alt"></i>Đăng Ký</a>
                                </div>
                        </div>
                    </div>
                    
                </div>
                <div class="header-menu">
                    <div class="content-menu">
                            <nav class="menu__title">
                                <ul class="title">
                                    <li><a class ="home" href="?action=home">TRANG CHỦ</a></li>
                                    <?php
                                         foreach($tam as $data){
                                            echo '<li><a href="?id='.$data['id'].'">'.$data['name'].'</a></li>';
                                        }
                                    ?>
                                    <li><a href="?action=introduce">GIỚI THIỆU</a></li>
                                    <li><a href="?action=contact">LIÊN HỆ</a></li>
                                    
                                </ul>
                                            
                            </nav> 
                            <div class="menu-search">
                                <form action="" method="POST">
                                    <input type="search" name="search" id="txtsearch" placeholder="Tìm kiếm">
                                    <button class="btn btn-search" title="Search" type="button" id="btnsearch" value="Search"><i class="fa fa-search"></i></button>             
                                </form>
                            </div>
                    </div>
                </div>
            </div>
        </header>
    </div>
</body>
</html>