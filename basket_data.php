<?php 
include ('HTML/db_test.php');
SESSION_START();
// $session_id = session_id();
$num = $_POST["num"];
$sql = "SELECT * FROM item WHERE num='$num'";
$result = mysqli_query($db, $sql);
$row = mysqli_fetch_assoc($result);
$count = $_POST["count"];
$sum = $count * $row["price"];
$image = $row["image"];
$brand = $row["brand"];
$product = $row["product"];
$price = $row["price"];
$grade = $row["grade"];
$category = $row["category"];
$id = $_SESSION['ID'];

$sql_image = image_CK("SELECT * from basket where image='$image'and session_id = '$id' ");  // sql문으로 입력된 id값을 선택하기 
$image_ck = $sql_image->fetch_array();  // 배열정렬시키기
if($image_ck==0){ //image값이 중복되지 않을 시 basket에 데이터 삽입
    $sql = "INSERT into basket(session_id, image, brand, product, price, count, sum, grade, category)
        values('$id','$image','$brand','$product','$price','$count','$sum','$grade','$category')";
    $result = mysqli_query($db, $sql);
}else{  //image값이 중복될 경우 해당 image 튜플의 conut, sum 에 더하기
    $sql = "UPDATE basket set count = count + $count, sum = sum + $sum where image ='$image'";
    $result = mysqli_query($db, $sql);
}

?>

<script>
    location.href='main.php';
</script>