<?php
session_start();
session_regenerate_id(true);

require_once "../common/layout.php";

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
print $email."にメールを送りましたのでご確認下さい。<br>";
print "商品は入金を確認次第、下記の住所に発送させて頂きます。<br>";
print $address."<br>";
print $tel."<br>";

$honbun = "";
$honbun .= $oname."様\n\nこの度はご注文ありがとうございました\n";
$honbun .= "\n";
$honbun .= "ご注文商品\n";
$honbun .= "-------------\n";

$dsn = "mysql:host=localhost;dbname=shop;charset=utf8";
$user = "root";
$password = "root";
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

$honbun .= $name."";
$honbun .= $price."円×";
$honbun .= $suryo."個=";
$honbun .= $shokei."円\n";
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


// $honbun .= "送料は無料です。\n";
// $honbun .= "-------------\n";
// $honbun .= "\n";
// $honbun .= "代金は以下の口座にお振込み下さい。\n";
// $honbun .= "A銀行　B支店　普通口座　1234567\n";
// $honbun .= "入金が確認取れ次第、商品を発送させていただきます。\n";
// $honbun .= "\n";
// $honbun .= "◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆\n";
// $honbun .= "　～ヘルニアショップ～\n";
// $honbun .= "\n";
// $honbun .= "東京都六本木ヒルズ最上階\n";
// $honbun .= "電話　090-0000-0000\n";
// $honbun .= "メール　hellnear@kmail.com\n";
// $honbun .= "◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆\n";
// print "<br>";
// print "nl2br($honbun)";


// $title = "ご注文ありがとうございました。";
// $header = "From:hellnear@kmail.com";
// $honbun = html_entity_decode($honbun, ENT_QUOTES, "UTF-8");
// mb_language("Japanese");
// mb_internal_encoding("UTF-8");
// mb_send_mail($email, $title, $honbun, $header);

// $title = "お客様よりご注文が入りました。";
// $header = "From:".$email;
// $honbun = html_entity_decode($honbun, ENT_QUOTES, "UTF-8");
// mb_language("Japanese");
// mb_internal_encoding("UTF-8");
// mb_send_mail("hellnear@kmail.com", $title, $honbun, $header);
}

catch(Exception $e) {
    print "只今障害により大変ご迷惑をおかけしております。";
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