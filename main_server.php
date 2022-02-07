<?php
include ('HTML/db_test.php');

$sql = "SELECT * FROM item WHERE 1 = 1";

if(isset($_POST['search'])){
    $search = $_POST['search'];
    $sql_search = " AND (brand LIKE '%$search%' OR product LIKE '%$search%')";
    $sql = $sql.$sql_search;
}

// 만약 seletrprice 중 체크된 것이 있을 때
if(isset($_POST['categoryCK'])){
    if(in_array('bed', $_POST['categoryCK'])){
        $text_category = " AND category = 'bed'";
    }
    else if(in_array('wardrobe', $_POST['categoryCK'])){ 
        $text_category = " AND category = 'wardrobe'";
    }
    else if(in_array('desk', $_POST['categoryCK'])){
        $text_category = " AND category = 'desk'";
    }
    else if(in_array('chair', $_POST['categoryCK'])){
        $text_category = " AND category = 'chair'";
    }
    else if(in_array('sofa', $_POST['categoryCK'])){
        $text_category = " AND category = 'sofa'";
    }
    else if(in_array('dining', $_POST['categoryCK'])){
        $text_category = " AND category = 'dining'";
    }
    else if(in_array('dresser', $_POST['categoryCK'])){
        $text_category = " AND category = 'dresser'";
    } 
    $sql = $sql.$text_category;
}

//만약 brandCK 중 체크된 것이 있을 때
if(isset($_POST['brandCK'])){
    if(in_array('all', $_POST['brandCK'])){
        $text_Brand = " AND 1 = 1";
    }
    else{
        $text_Brand = " AND brand IN (";
        for($i=0; $i<count($_POST['brandCK']); $i++){
            $setBrandCK = $_POST['brandCK'];

            if($i > 0){
                $text_Brand = $text_Brand.",";
            }

            $text_Brand = $text_Brand."'".$setBrandCK[$i]."'";
        }
        $text_Brand = $text_Brand.")";
    }
    // $sql_text_brand = "SELECT * FROM test WHERE 1 = 1".$text;
    $sql = $sql.$text_Brand;
}

// 만약 seletrprice 중 체크된 것이 있을 때
if(isset($_POST['selectprice'])){
    if(in_array('allprice', $_POST['selectprice'])){
        $text_seletrprice = " AND price";
    }
    else if(in_array('underprice', $_POST['selectprice'])){
        $text_seletrprice = " AND price<=500000";
    }else if(in_array('middleprice', $_POST['selectprice'])){ 
        $text_seletrprice = " AND price>=500000 AND price<=1000000";
    }else if(in_array('topprice', $_POST['selectprice'])){
        $text_seletrprice = " AND price>=1000000";
    } 
    $sql = $sql.$text_seletrprice;
}

//만약 od 중 체크된 것이 있을 때
if(isset($_POST['od'])){
    if(in_array('lowprice', $_POST['od'])){
        $text_Od = " order by price";
    }else if(in_array('highprice', $_POST['od'])){ 
        $text_Od = " order by price DESC";
    }else if(in_array('lowpgrade', $_POST['od'])){
        $text_Od = " order by grade";
    }else if(in_array('highgrade', $_POST['od'])){
        $text_Od = " order by grade DESC";
    }
    $sql = $sql.$text_Od;
}

else if((!isset($_POST['search'])) AND (!isset($_POST['od'])) AND (!isset($_POST['brandCK'])) 
        AND (!isset($_POST['selectprice'])) AND (!isset($_POST['categoryCK']))){ # 처음 메인화면
    $sql = "SELECT * FROM item where grade = '5'";
}

//동적 sql 구현 후 DB에 접근하기
$result = mysqli_query($db, $sql);
//DB에 접근해서 얻어온 게 실제로 몇 행이 있는지 파악
$count = mysqli_num_rows($result);

// 파악한 행이 만약 0개라면 다음 alert 메시지 팝업 띄우고 다시 main 화면으로 넘어감
if($count == 0 )
{
    echo "<script>alert(\"선택하신 조건에 일치하는 상품이 없습니다. \\n메인 화면으로 이동합니다.\");</script>";
    mysqli_close($db);
    echo "<meta http-equiv='refresh' content='0;url=main.php'>";
}
?>
