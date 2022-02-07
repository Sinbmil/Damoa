<?php 
include ('HTML/db_test.php');
SESSION_START();
// $session_id = session_id();
$id = $_SESSION['ID'];
$num = $_GET['num'];
// 제품의 num과 장바구니에 담겨있는 num이 같고 session_id가 나의 session_id일때 삭제한다.
$sql = "DELETE from basket where num = '$num' and session_id = '$id'";
$result = mysqli_query($db, $sql);

?>
<script>
    location.href='basket.php';
</script>