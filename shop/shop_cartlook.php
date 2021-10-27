<?php

session_start();
session_regenerate_id(true);

require_once "../common/layout.php";

print "<main class='main'>";
print "<div class='left'>";

if(isset($_SESSION["member_login"]) === false) {
    print "ログインしてください。<br><br>";
    print "<a href='../member_login/member_login.php'>ログイン画面へ</a>";
    exit();
} else {
    print "ようこそ";
    print $_SESSION["member_name"];
    print "様　";
    print "<a href='../member_login/member_logout.php'>ログアウト</a>";
    print "<br><br>";
}


if(empty($_SESSION["cart"]) === true) {
    print "カートに商品はありません。<br><br>";
    print "<a href='shop_list.php'>商品一覧へ戻る</a>";
    exit();
}

try{
$cart = $_SESSION["cart"];
$kazu = $_SESSION["kazu"];
$max = count($cart);

$dsn = "mysql:host=mysql78.conoha.ne.jp;dbname=9adb7_cmp_02_db;charset=utf8";
$user = "9adb7_ybf_cmp_02";
$password = "gX+ibjR3-bPk";
$dbh = new PDO($dsn, $user, $password);
$dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

foreach($cart as $key => $val) {

$sql = "SELECT code, name, price, gazou FROM mst_product WHERE code=?";
$stmt = $dbh -> prepare($sql);
$data[0] = $val;
$stmt -> execute($data);

$rec = $stmt -> fetch(PDO::FETCH_ASSOC);

$name[] = $rec["name"];
$price[] = $rec["price"];
$gazou[] = $rec["gazou"];
}
$dbh = null;
}
catch(Exception $e) {
    print "只今障害が発生しております。<br><br>";
    print "<a href='../member_login/member_login.php'>ログイン画面へ</a>";
}
?>

        <form action="shop_kazu.php" method="post">
        <h1>カート一覧</h1><br><br>
        <?php for($i = 0; $i < $max; $i++) {;?>
        <?php if(empty($gazou[$i]) === true) {;?>
        <?php $disp_gazou = "";?>
        <?php } else {;?>
        <?php $disp_gazou = "<img  class='img' src='../product/gazou/".$gazou[$i]."'>";?>
        <?php };?>
        <?php print $disp_gazou;?><br>
        商品名:<?php print $name[$i];?><br>
        価格:<?php print $price[$i]."円　";?><br>
        数量:<input type="text" name="kazu<?php print $i;?>" value="<?php print $kazu[$i];?>"><br>
        合計価格:<?php print $price[$i] * $kazu[$i]."円";?><br><br>
        削除:<input type="checkbox" name="delete<?php print $i;?>">
        <br>

        <?php };?>

        <br><br>
        <input type="hidden" name="max" value="<?php print $max;?>">
        <input type="submit" value="数量変更/削除">
        <br><br>
        <input type="button" onclick="history.back()" value="戻る">
        </form>
        <br>
        <a href="shop_list.php">商品一覧へ戻る</a><br>
        <a href="shop_form_check.php">ご購入手続きへ進む</a><br>
        <br><br>
    </div>

    <div class="right">
        <div><img class="ad-img" src="../product/gazou/adv-1.png" alt="#"></div>
        <div><img class="ad-img" src="../product/gazou/adv-2.png" alt="#"></div>
        <div><img class="ad-img" src="../product/gazou/adv-3.jpg" alt="#"></div>
    </div>
</main>
</body>
</html>