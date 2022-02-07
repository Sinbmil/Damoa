<?php
include ('HTML/db_test.php');
SESSION_START();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>DAMOA</title>
        <meta charset="utf-8">
        <meta name="keywords" content="HTML5, CSS, JQUERY">

        <!--반응형 웹 영역-->
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!--글자폰트 영역-->
        <link rel="preconnect" href="https://fonts.googleapis.com/%22%3E">
        <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic+Coding&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Hi+Melody&family=Nanum+Gothic+Coding&family=Sunflower:wght@300&display=swap" rel="stylesheet">

        <!--이모티콘 영역-->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/v4-shims.css">
       
        <!-- 외부 css연결 -->
        <link rel ="stylesheet" type ="text/css" href ="CSS/main.css">
    </head>

    <body>
        <?php
        if(!isset($_SESSION['ID']) || !isset($_SESSION['password'])){
            echo "<script>alert('로그인을 해주세요.')</script>";
            echo "<meta http-equiv='refresh' content='0;url=main.php'>";
        }else {
    ?>
    <div class="primary">
        <!-- 로그인 영역 -->
        <div style ="display: inline-block;">
                <?php
                if(!isset($_SESSION['ID']) || !isset($_SESSION['password'])) {
                    echo "로그인을 해주세요. <a href=\"html/login.php\"><i class=\"fas fa-sign-in-alt\"></i>로그인</a>";
                } else {
                    $ID = $_SESSION['ID'];
                    $password = $_SESSION['password'];
                    $nickname = $_SESSION['nickname'];
                    echo "$nickname 님 환영합니다. ";
                    echo "<a href=\"html/logout.php\"><i class=\"fas fa-sign-out-alt\"></i>로그아웃</a>";?>
                    <a href="basket.php">장바구니</a>
                    <?php 
                }
               ?>
        </div>
        </div>
        <!-- 로그인 영역 -->
        
        <!-- 헤더영역 시작  -->
        <header class="header">
            <span id="logo">
                <div><a href="main.php" style="color: white;">DAMOA</a></div>
            </span>
		</header>
		<!-- 헤더영역 끝 -->
        <!-- 콘텐츠 및 섹션 영역 시작 -->
         
        <!-- 콘텐츠 및 섹션 영역 끝 -->
        <?php 
        $num = $_GET['num'];
        $sql = "SELECT * FROM item where num='$num'";
        $result = mysqli_query($db, $sql);
        ?>
        <!-- 장바구니 페이지로 데이터 전송-->
        <form action ="basket_data.php" method ="post">
        <input type= "hidden" name = "num" value ="<?php echo $num;?>">
            <div class= "row tm-gallary">
                <div class="tm-gallery-page">
                <figcaption>
                <?php
                while($row = mysqli_fetch_assoc($result)) {
                ?>
                <article class="padd max-width">
                <img src="<?php echo $row["image"];?>" width="250px;" height="315px;"></a>
                <b>
                <?php
                echo $row["brand"]; ?> </b><br>
                <?php
                    echo $row["product"];
                ?> <br>
                <?php
                echo number_format($row["price"]);?><?php
                echo "원";?></b><br>
                <?php
                echo "평 점 : ";
                echo $row["grade"];
                ?>
                <br>
                <?php
                echo "수량"?>
                <select name = "count">
                    <option value ='1'> 1개
                    <option value ='2'> 2개
                    <option value ='3'> 3개
                    <option value ='4'> 4개
                    <option value ='5'> 5개
                    <option value ='6'> 6개
                    <option value ='7'> 7개
                </select>
                <br>
                <input type ="submit" value ="장바구니 담기">
                <br>
                </figcaption>
                </article>
                <?php
                }
                mysqli_close($db); // 디비 접속 닫기
                ?>
                </div>
            </div>
        </form>
        
        <div style="text-align:center">
            <a href = "main.php">목록으로 이동</a>
        </div>
        <?php }
        ?>
    </body>
</html>