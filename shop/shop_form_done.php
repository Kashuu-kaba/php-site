<?php
session_start();
session_regenerate_id(true);

require_once "../common/layout.php";

print "<main class='main'>";
print "<div class='left'>";

if(isset($_SESSION["member_login"]) === false) {
    print "ログインしてく下さい。<br><br>";
    print "<a href='../member_login/member_login.html'>ログイン画面へ<br><br></a>";
    print "<a href='shop_list.php'>TOP画面へ</a>";
    exit();
}
if(isset($_SESSION["member_login"]) === true) {
    print "ようこそ";
    print $_SESSION["member_name"];
    print "様　";
    print "<a href='../member_login/member_logout.php'>ログアウト</a>";
    print "<br><br>";
}

 try {

require_once("../common/common.php");

$post = sanitize($_POST);

$oname = $post["name"];
$email = $post["email"];
$address = $post["address"];
$tel = $post["telephone"];
$cart = $_SESSION["cart"];
$kazu = $_SESSION["kazu"];
$max = count($cart);

print $oname."様<br>";
print "ご注文ありがとうございました。<br>";
print "商品は入金を確認次第、下記の住所に発送させて頂きます。<br>";
print $address."<br>";
print $tel."<br>";


$dsn = "mysql:host=mysql78.conoha.ne.jp;dbname=9adb7_cmp_02_db;charset=utf8";
$user = "9adb7_ybf_cmp_02";
$password = "gX+ibjR3-bPk";
$dbh = new PDO($dsn, $user, $password);
$dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

for($i = 0; $i < $max; $i++) {

$sql = "SELECT name, price FROM mst_product WHERE code=?";
$stmt = $dbh -> prepare($sql);
$data[0] = $cart[$i];
$stmt -> execute($data);

$rec = $stmt -> fetch(PDO::FETCH_ASSOC);

$name = $rec["name"];
$price = $rec["price"];
$kakaku[] = $price;
$suryo = $kazu[$i];
$shokei = $price * $suryo;

}

$sql = "LOCK TABLES dat_sales_product WRITE";
$stmt = $dbh -> prepare($sql);
$stmt -> execute();

for($i = 0; $i < $max; $i++) {
$sql = "INSERT INTO dat_sales_product(sales_member_code, code_product, price, quantity, time) VALUES(?,?,?,?,now())";
$stmt = $dbh -> prepare($sql);
$data = array();
$data[] = $_SESSION["member_code"];
$data[] = $cart[$i];
$data[] = $kakaku[$i];
$data[] = $kazu[$i];
$stmt -> execute($data);
}

$sql = "UNLOCK TABLES";
$stmt = $dbh -> prepare($sql);
$stmt -> execute();


}

catch(Exception $e) {
    print "只今障害により大変ご迷惑をおかけしております。";
    print "<a href='../member_login/member_login.php'>ログイン画面へ</a>";
    echo $e->getMessage();
    exit();
}

?>

<br>
    <?php $_SESSION["cart"] = array();?>
    <?php $_SESSION["kazu"] = array();?>
    <a href="shop_list.php">商品画面へ</a>
<br><br>

</body>
</html>