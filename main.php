<?php
include 'main_server.php';
SESSION_START();
?>
<!-- 메인UI 화면 -->
<!DOCTYPE html>
<html>
    <head>
        <title>DAMOA</title>
        <meta charset="utf-8">
	    <meta name="keywords" content="HTML5, CSS, JQUERY">
        
        <!--반응형 웹 영역-->
        <meta name="viewport" content="width=device-width, initial-scale=1">
       
        <!--글자폰트 영역-->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic+Coding&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Hi+Melody&family=Nanum+Gothic+Coding&family=Sunflower:wght@300&display=swap" rel="stylesheet">
      
        <!--이모티콘 영역-->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/v4-shims.css">
       
        <!-- 외부 css연결 -->
        <link rel ="stylesheet" type ="text/css" href ="CSS/main.css">
    </head>
    
    <body>
        <form method = "POST" action = "<?php echo $_SERVER['PHP_SELF'] ;?>" >    
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
            <!-- 검색창 영역-->
            <span class = "box">
                <div class="container-1">
                  <span class="icon"><i class="fa fa-search"></i></span>
                  <input type="text" id="search" placeholder="Search..." name ="search" style="height:35px;" />
                </div>
            </span>
            <!-- 검색창 영역-->
		</header>
		<!-- 헤더영역 끝 -->
        <!-- 콘텐츠 및 섹션 영역 시작 -->
        <div class="content_div">
            <article>
                <header>                
                    <div class ="tab_wrapper">					    
                        <label><input type="radio" name="od[]" value="lowprice" <?php if(isset($_POST['od']) && in_array("lowprice",
                                $_POST['od'])) echo 'checked="checked"' ?>/> 낮은 가격순 </label>
                        <label><input type="radio" name="od[]" value="highprice" <?php if(isset($_POST['od']) && in_array("highprice",
                                $_POST['od'])) echo 'checked="checked"' ?>/> 높은 가격순</label>
                        <label><input type="radio" name="od[]" value="lowpgrade" <?php if(isset($_POST['od']) && in_array("lowpgrade",
                                $_POST['od'])) echo 'checked="checked"' ?>/> 별점 낮은순</label>
                        <label><input type="radio" name="od[]" value="highgrade" <?php if(isset($_POST['od']) && in_array("highgrade",
                                $_POST['od'])) echo 'checked="checked"' ?>/> 별점 높은순</label>
                        <input type="submit" value= "검색">

                        <hr style="border: solid 2px; color:gray;"><br>
                    </div>                    
                </header>   
            </article>
			<aside class="aside">
				<br>&emsp;<font size = "5px" color="black">&ensp;Menu</font><br>
                    <dl class="accor lnb-sort">
                        <div style="display: block;">  
                            <ul class="lnb-sort-list" style="padding-inline-start: 20px;">
                                <li><label><input type="radio" name="categoryCK[]" value="bed" <?php if(isset($_POST['categoryCK']) && in_array("bed",
                                $_POST['categoryCK'])) echo 'checked="checked"' ?>/>침대</label></li>
                                <li><label><input type="radio" name="categoryCK[]" value="wardrobe" <?php if(isset($_POST['categoryCK']) && in_array("wardrobe",
                                $_POST['categoryCK'])) echo 'checked="checked"' ?>/>옷장</label></li>
                                <li><label><input type="radio" name="categoryCK[]" value="desk" <?php if(isset($_POST['categoryCK']) && in_array("desk",
                                $_POST['categoryCK'])) echo 'checked="checked"' ?>/>책상</label></li>
                                <li><label><input type="radio" name="categoryCK[]" value="chair" <?php if(isset($_POST['categoryCK']) && in_array("chair",
                                $_POST['categoryCK'])) echo 'checked="checked"' ?>/>의자</label></li>
                                <li><label><input type="radio" name="categoryCK[]" value="sofa" <?php if(isset($_POST['categoryCK']) && in_array("sofa",
                                $_POST['categoryCK'])) echo 'checked="checked"' ?>/>소파</label></li>
                                <li><label><input type="radio" name="categoryCK[]" value="dining" <?php if(isset($_POST['categoryCK']) && in_array("dining",
                                $_POST['categoryCK'])) echo 'checked="checked"' ?>/>식탁</label></li>
                                <li><label><input type="radio" name="categoryCK[]" value="dresser" <?php if(isset($_POST['categoryCK']) && in_array("dresser",
                                $_POST['categoryCK'])) echo 'checked="checked"' ?>/>서랍장/수납장</label></li>
                            </ul>
                        </div>
                    </dl>
				<div class="lnb-cont accor-sect">
					<dl class="accor lnb-sort">
						<dt class="accor-tit on"><font size = "5px">&ensp;&ensp;브랜드</font></dt>
                            <div style="display: block;">
                                <ul class="lnb-sort-list" style="padding-inline-start: 20px;">
                                    <?php
                                    #브랜드별로 제품의 개수가 많은 순으로 item테이블에서 브랜드를 출력한다.
                                        $sql2 = "SELECT brand, count(*) FROM item GROUP BY brand ORDER BY count(*) desc";
                                        $result2 = mysqli_query($db, $sql2);
                                    ?>
                                     <li><label><input type="checkbox" name="brandCK[]" value="all" <?php if(isset($_POST['brandCK']) && in_array("all",
                                     $_POST['brandCK'])) echo 'checked="checked"' ?>/>전체</label></li>
                                    <?php    
                                        while($row = mysqli_fetch_assoc($result2)) {?>
                                            <li><label><input type="checkbox" name="brandCK[]" value="<?php echo $row["brand"];?>" <?php if(isset($_POST['brandCK']) 
                                            && in_array($row["brand"],$_POST['brandCK'])) echo 'checked="checked"' ?>/><?php echo $row["brand"];?></label></li>
                                        <?php
                                    }?>
                                </ul>
                            </div>                        

						<dt class="accor-tit on"><font size = "5px"><br>&emsp;가격대</font></dt>
						<div style="display: block;">
							<ul class="lnb-sort-list" style="padding-inline-start: 20px;">
                                <li><label><input type="radio" name="selectprice[]" value="allprice" <?php if(isset($_POST['selectprice']) && in_array("allprice",
                                $_POST['selectprice'])) echo 'checked="checked"' ?>/>전체</label></li>        
                                <li><label><input type="radio" name="selectprice[]" value="underprice" <?php if(isset($_POST['selectprice']) && in_array("underprice",
                                $_POST['selectprice'])) echo 'checked="checked"' ?>/>50만원 이하</label></li>
                                <li><label><input type="radio" name="selectprice[]" value="middleprice" <?php if(isset($_POST['selectprice']) && in_array("middleprice",
                                $_POST['selectprice'])) echo 'checked="checked"' ?>/>50만원 ~ 100만원</label></li>
                                <li><label><input type="radio" name="selectprice[]" value="topprice" <?php if(isset($_POST['selectprice']) && in_array("topprice",
                                $_POST['selectprice'])) echo 'checked="checked"' ?>/>100만원 이상</label></li>
							</ul>
						</div>
					</dl>
				</div>
			</aside>
        </div>
        <!-- 콘텐츠 및 섹션 영역 끝 -->

        <div class= "row tm-gallary">
                <div class="tm-gallery-page">
                        <figcaption>
                            <!-- 데이터베이스 테이블 가져와서 순서대로 데이터 출력 영역-->
                            <?php
                                    $result = mysqli_query($db, $sql);
                                    while($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <article class="padd max-width">
                                    <a href ="cart.php?num=<?php echo $row["num"]?>"><img src="<?php echo $row["image"];?>" width="250px;" height="315px;"></a>
                                    <b>
                                    <a href ="cart.php?num=<?php echo $row["num"]?>"><?php echo $row["brand"]; ?></a></b><br>
                                    <a href ="cart.php?num=<?php echo $row["num"]?>">
                                    <?php
                                        echo $row["product"];
                                    ?> <br>
                                    <?php
                                    echo number_format($row["price"]);?><?php
                                    echo " 원";?></b><br>
                                   <?php
                                    echo "평 점 : ";
                                    echo $row["grade"];?><br>

                                    </figcaption>
                                    </article>
                                    <?php
                                    }
                                    mysqli_close($db); // 디비 접속 닫기
                                ?>
                </div>
        </div>
                    <!-- 데이터베이스 테이블 가져와서 순서대로 데이터 출력 영역-->
        </form>
    </body>
</html>