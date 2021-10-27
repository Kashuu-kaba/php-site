<?php
session_start();
session_regenerate_id(true);

require_once "../common/layout.php";

if(isset($_SESSION["member_login"]) === true) {
print "ようこそ";
    print $_SESSION["member_name"];
    print "様　";
    print "<a href='../member_login/member_logout.php'>ログアウト</a>";
    print "<br><br>";
}

try{

$dsn = "mysql:host=mysql78.conoha.ne.jp;dbname=9adb7_cmp_02_db;charset=utf8";
$user = "9adb7_ybf_cmp_02";
$password = "gX+ibjR3-bPk";
$dbh = new PDO($dsn, $user, $password);
$dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = "SELECT code,name,price,gazou,explanation FROM product WHERE category=?";
$stmt = $dbh -> prepare($sql);
$data[] = "化粧品";
$stmt -> execute($data);

$dbh = null;

print "販売商品一覧";
print "　<a href='shop_cartlook.php'>カートを見る</a>";
print "<br><br>";

print "<main class='main'>";
print "<div class='left'>";

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
    }
    print $gazou;
    print "<br>";
    print "商品名:".$rec["name"];
    print "<br>";
    print "価格:".$rec["price"]."円";
    print "<br>";
    print "詳細:".$rec["explanation"];
    print "</a>";
    print "<br>";
}
print "<br>";

}
catch(Exception $e) {
    print "只今障害が発生しております。<br><br>";
    print "<a href='../member_login/member_login.php'>ログイン画面へ</a>";
}
?>
<a href="shop_list.php">トップページへ戻る</a>
<br><br><br>

    <h3>カテゴリー</h3>
    <ul>
        <li><a href="shop_list_kenko.php">健康食品</a></li>
        <li><a href="shop_list_cosme.php">化粧品</a></li>
        <li><a href="shop_list_honey.php">はちみつ食品</a></li>
    </ul>
</div>

<div class="right">
    <div><img class="ad-img" src="../product/gazou/adv-1.png" alt="#"></div>
    <div><img class="ad-img" src="../product/gazou/adv-2.png" alt="#"></div>
    <div><img class="ad-img" src="../product/gazou/adv-3.jpg" alt="#"></div>
</div>
</main>

</body>
</html>