<?php 
include 'basket_server.php';

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
                    <!-- 계정UI 영역 -->
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
        <div class="content_div">
            <article>
                <header>                
                    <div class ="tab_wrapper">					    
                        <label><input type="radio" name="od[]" value="lowprice"> 낮은 가격순 </label>
                        <label><input type="radio" name="od[]" value="highprice"> 높은 가격순</label>
                        <label><input type="radio" name="od[]" value="lowpgrade"> 별점 낮은순</label>
                        <label><input type="radio" name="od[]" value="highgrade"> 별점 높은순</label>
                        <input type="submit" value= "검색">
                        

                        <hr style="border: solid 2px; color:gray;"><br>
                    </div>                    
                </header>   
            </article>
			<aside class="aside">
				<br>&emsp;<font size = "5px" color="black">&ensp;Menu</font><br><br>
				<dl class="accor lnb-sort">
                        <div style="display: block;">  
                            <ul class="lnb-sort-list" style="padding-inline-start: 20px;">
                                <li><label><input type="radio" name="categoryCK[]" value="bed">침대</label></li>
                                <li><label><input type="radio" name="categoryCK[]" value="wardrobe">옷장</label></li>
                                <li><label><input type="radio" name="categoryCK[]" value="desk">책상</label></li>
                                <li><label><input type="radio" name="categoryCK[]" value="chair">의자</label></li>
                                <li><label><input type="radio" name="categoryCK[]" value="sofa">소파</label></li>
                                <li><label><input type="radio" name="categoryCK[]" value="dining">식탁</label></li>
                                <li><label><input type="radio" name="categoryCK[]" value="dresser">서랍장/수납장</label></li>
                            </ul>
                        </div>
                    </dl>		
				<div class="lnb-cont accor-sect">
					<dl class="accor lnb-sort">
						<dt class="accor-tit on"><font size = "5px">&ensp;&ensp;브랜드</font></dt>
                            <div style="display: block;">
                                <ul class="lnb-sort-list" style="padding-inline-start: 20px;">
                                <?php
                                $sql2 = "SELECT brand, count(*) FROM item GROUP BY brand ORDER BY count(*) desc";
                                $result2 = mysqli_query($db, $sql2);
                                    while($row = mysqli_fetch_assoc($result2)) {?>
                                        <li><label><input type="checkbox" name="brandCK[]" value="<?php echo $row["brand"];?>"><?php echo $row["brand"];?></label></li>
                                       <?php
                                        }
                                ?>
                                </ul>
                            </div>                        

						<dt class="accor-tit on"><font size = "5px"><br>&emsp;가격대</font></dt>
						<div style="display: block;">
							<ul class="lnb-sort-list" style="padding-inline-start: 20px;">
                                <li><label><input type="radio" name="selectprice[]" value="underprice">50만원이하</label></li>
                                <li><label><input type="radio" name="selectprice[]" value="middleprice">50만원~100만원</label></li>
                                <li><label><input type="radio" name="selectprice[]" value="topprice">100만원이상</label></li>
                            </ul>
						</div>
					</dl>
				</div>
			</aside>
        </div>
        <!-- 콘텐츠 및 섹션 영역 끝 -->

        <div class= "row tm-gallary">
                <div class="tm-gallery-page">
                    <div class= "row tm-gallary">
                        <div class="tm-gallery-page">
                            <figcaption>
                            <?php
                            #$sql = "SELECT * from basket where session_id = '$session_id' ";
                            $result = mysqli_query($db, $sql);
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
                            <?php echo "수량 :" ?>
                            <?php echo $row["count"];?><br>
                            <?php echo "합계 :" ?>
                            <?php echo number_format($row["sum"]);?><br>
                            <?php
                            echo "평 점 : ";
                            echo $row["grade"];?>
                            <br>
                            <a style = "color:blue"; href="basket_del.php?num=<?php echo $row["num"]?>" onclick="return confirm('정말 삭제하시겠습니까?')">삭제</a>
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
        </form>
    </body>
</html>