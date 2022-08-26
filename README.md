# 데이터베이스를 이용한 종합 가구 사이트
# 1) 개발 배경 및 목적
## 1. 개발 배경
* 코로나 19 사태 이후 많은 사람들이 인테리어에 대한 관심도가 증가
* 기사를 보면 알 수 있듯이 90% 이상의 비율이 코로나로 인해 집에 머무르는 시간이 증가<br>
-> https://www.donga.com/news/Economy/article/all/20210130/105190059/1
## 2. 개발 목적
* 종합 가구 사이트를 만듦으로써 소비자가 원하는 가구를 카테고리 및 가격대에 맞춰 손쉽게 검색할 수 있는 편리한 효과
<hr/>

# 2) 데이터베이스 설계 및 구축
## 1. E-R 다이어그램
<p align="center">
  <img src="https://user-images.githubusercontent.com/83913056/178133355-338da2c1-f6e7-4b35-8a5a-195d26c4a865.png">
</p>  

### [1] 회원(member) 테이블
* 회원번호, 아이디, 비밀번호, 닉네임, 이름, 이메일, 전화번호 정보 저장

### [2] 상품(item) 테이블
* 상품번호, 이미지링크, 브랜드, 상품명, 가격, 별점, 상품종류 정보 저장

### [3] 장바구니(basket) 테이블
* 상품종류, 평점, 상품별총합, 상품 개수, 가격 정보 저장

## 2. CRUD
<p align="center">
  <img src="https://user-images.githubusercontent.com/83913056/178133479-7cf5bba0-f33e-4368-a69b-dab67825ff12.png">
</p>

* 엔티티는 회원, 장바구니, 상품으로 구성되어 있습니다.
* 프로세스는 회원정보는 등록, 수정, 장바구니는 등록, 수정, 삭제, 조회 상품에는 등록, 조회가 있습니다.

<hr/>

# 3) 시스템 구현
## 1. 개발 환경
<p align="center">
 <img src="https://user-images.githubusercontent.com/83913056/170942888-82788db3-e569-4846-a65f-9247434f6aac.png">
</p>

## 2. 주요 기능 구현
### [1] 공통 변수 선언
```php
<?php
  include ('HTML/db_test.php');
  $sql = "SELECT * FROM item WHERE 1 = 1";
?>
```
* sql 변수에 아이템 테이블 정보를 가져온 후, 각 체크박스의 체크 유무를 확인하여 AND 연산자를 통해 SELECT 합니다.

### [2] 체크박스 구현
```php
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
```

* 브랜드는 다중선택이 가능하며 in_array()에 all을 사용하면서 브랜드 전체를 검색할 수 있도록 구현하였다.
* $text_Brand = "AND 1= 1"을 해준 이유는 다른 브랜드를 선택하고 전체를 클릭했을 때도 전체 브랜드가 나타내기 하도록 위함이다.
* 전체를 선택하지 않고 일부만 선택했을 때는 for문과 IN 연산자를 이용해서 브랜드가 체크된 값을 얻어오고 그 수량이 0보다 크면 중간에 콤마 표시를 해주면서 연결을 해준다. 
  작은 따음표라던지 괄호를 위에서 말한 것처럼  점(.)을 사용해서 연결을 해준다.
  
-> 상단 코드는 브랜드별 체크박스 유무 확인이고 다른 것도 비슷하게 구현하였다.

### [3] 검색 엔진 구현
```php
if(isset($_POST['search'])){
    $search = $_POST['search'];
    $sql_search = " AND (brand LIKE '%$search%' OR product LIKE '%$search%')";
    $sql = $sql.$sql_search;
}
```

* 메인 페이지의 입력창이 search인데 브랜드 또는 제품명을 LIKE 문을 이용해서 검색 엔진을 구현한 것을 $sql_search에 넣어주고 PHP에서는 한 변수와 다른 변수를 연결할 때 .을 
  사용하기에 공통변수인 $sql와 $sql_search를 점(.)으로 연결해준 값을 $sql에 넣어주었다.

## 3. UI 구성 및 흐름
<p align="center">
  <img src="https://user-images.githubusercontent.com/83913056/186619849-758ba85d-510a-4292-915e-e957a438e3b7.JPG">
</p>

* 우선, 사용자가 사용자 인증을 통한 회원가입 이후 로그인을 하게 되면, 메인 페이지로 이동하게 됩니다. 
* 메인 페이지에 존재하는 상품들 중에서 사용자는 본인이 원하는 상품을 클릭하면 상품 페이지로 이동합니다.
* 상품 페이지 내에서 구매하고 싶은 수량을 체크하고 장바구니에 담으면 서버를 통해 장바구니에 담은 상품을 볼 수 있게 됩니다.
* 메인 페이지와 장바구니  페이지에서는 각 상품에 대한 브랜드, 가격, 별점 등을 확인할 수 있습니다.
* 사용자는 단순히 이것을 보기만 하는 것이 아니라 카테고리별, 브랜드별, 가격대별, 별점별 등을 기준으로도 검색하여 선택의 폭을 줄일 수 있습니다.
* 추가적으로 메인 페이지에서는 검색 엔진을 통해서 상품을 확인할 수 있습니다.

시연 영상 및 기타정보는 wiki에서 확인할 수 있습니다.<br>
-> https://github.com/Sinbmil/Damoa/wiki/%EB%8D%B0%EC%9D%B4%ED%84%B0%EB%B2%A0%EC%9D%B4%EC%8A%A4%EB%A5%BC-%EC%9D%B4%EC%9A%A9%ED%95%9C-%EC%A2%85%ED%95%A9-%EA%B0%80%EA%B5%AC-%EC%82%AC%EC%9D%B4%ED%8A%B8
