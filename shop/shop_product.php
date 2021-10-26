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

$code = $_GET["code"];

$dsn = "mysql:host=localhost;dbname=shop;charset=utf8";
$user = "root";
$password = "root";
$dbh = new PDO($dsn, $user, $password);
$dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = "SELECT code, name, price, gazou, explanation FROM mst_product WHERE code=?";
$stmt = $dbh -> prepare($sql);
$data[] = $code;
$stmt -> execute($data);

$dbh = null;

$rec = $stmt -> fetch(PDO::FETCH_ASSOC);

if(empty($rec["gazou"]) === true) {
    $disp_gazou = "";
} else {
    $disp_gazou = "<img class='img' src='../product/gazou/".$rec['gazou']."'>";
}

}
catch(Exception $e) {
    print "只今障害が発生しております。<br><br>";
    print "<a href='../staff_login/staff_login.html'>ログイン画面へ</a>";
}
?>
<a href="shop_cartin.php?code=<?php print $code;?>">カートに入れる</a>
<br><br>
<?php print $disp_gazou;?>
<br>
商品名:<?php print $rec['name'];?>
<br>
価格:<?php print $rec['price'];?>円
<br>
詳細:<?php print $rec['explanation'];?>

<br><br>
<form>
<input type="button" onclick="history.back()" value="戻る">
</form>

<h3>カテゴリー</h3>
<li><a href="shop_list_kenko.php">健康食品</a></li>
<li><a href="shop_list_cosme.php">化粧品</a></li>
<li><a href="shop_list_honey.php">はちみつ食品</a></li>

</body>
</html>