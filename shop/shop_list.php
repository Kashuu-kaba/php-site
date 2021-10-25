<?php
session_start();
session_regenerate_id(true);

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ECサイトTOP</title>
    <link rel="stylesheet" href="../shop_list.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="http://code.jquery.com/jquery-3.3.1.js"></script>
</head>

<body>
    <header>
        <div><h1 class="logo"><a href="./top.html"> 山田養蜂場</a></h1></div>
        <div class="nav-toggle">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </header>
    <div class="nav-wrapper">
        <ul>
            <li><a href="">このページ</a></li>
            <li><a href="#">マイカート一覧</a></li>
            <li><a href="#">カテゴリー別商品一覧</a></li>
            <li><a href="#">メニュー4</a></li>
        </ul>
    </div>

<?php
try{
    if(isset($_SESSION["member_login"]) === true) {
    print "ようこそ";
        print $_SESSION["member_name"];
        print "様　";
        print "<a href='../member_login/member_logout.php'>ログアウト</a>";
        print "<br><br>";
    }

$dsn = "mysql:host=localhost;dbname=shop;charset=utf8";
$user = "root";
$password = "root";
$dbh = new PDO($dsn, $user, $password);
$dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = "SELECT code,name,price,gazou,explanation FROM mst_product WHERE1";
$stmt = $dbh -> prepare($sql);
$stmt -> execute();

$dbh = null;

print "販売商品一覧";
print "　<a href='shop_cartlook.php'>カートを見る</a>";
print "<br><br>";

while(true) {
    $rec = $stmt -> fetch(PDO::FETCH_ASSOC);
    if($rec === false) {
        break;
    }
    $code = $rec["code"];
    print "<a href='shop_product.php?code=".$code."'>";
    if(empty($rec["gazou"]) === true) {
        $gazou = "";
      } else {
        $gazou = "<img class='img' src='../product/gazou/".$rec['gazou']."'>";
        // $img = base64_encode($rec["gazou"]);
        // print "<img src='data:image/png;base64,"$img"'>";
    }
    // print $gazou;
    // print "<br>";
    // print "商品名:".$rec["name"];
    // print "<br>";
    // print "価格:".$rec["price"]."円";
    // print "<br>";
    // print "詳細:".$rec["explanation"];
    // print "</a>";
    // print "<br><br>";
    ?>

<main class="main">
    <div class='box'>
        <div class='list'>
            <div class='img'>
                <?php print $gazou; ?>
            </div>
            <div class='npe'>
                <?php "商品名:".$rec["name"] ?><br>
                <?php print "価格:".$rec["price"]."円" ?><br>
                <?php print "詳細:".$rec["explanation"] ?>
            </div>
        </div>
    </div>
    <?php
    print "</a>";
    print "<br>";
}
print "<br>";

}
catch(Exception $e) {
    print "只今障害が発生しております。<br><br>";
    print "<a href='../staff_login/staff_login.html'>ログイン画面へ</a>";
}
?>

<h3>カテゴリー</h3>
    <ul>
        <li><a href="shop_list_eart.php">食品</a></li>
        <li><a href="shop_list_kaden.php">家電</a></li>
        <li><a href="shop_list_book.php">書籍</a></li>
        <li><a href="shop_list_niti.php">日用品</a></li>
        <li><a href="shop_list_sonota.php">その他</a></li>
    </ul>

</main>
</body>
<script src="../javascript.js"></script>
</html>