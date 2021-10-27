<?php

session_start();
session_regenerate_id(true);

require_once "../common/layout.php";

print "<main class='main'>";
print "<div class='left'>";

if(isset($_SESSION["member_login"]) === true) {
print "ようこそ";
    print $_SESSION["member_name"];
    print "様　";
    print "<a href='../member_login/member_logout.php'>ログアウト</a>";
    print "<br><br>";
}

try{

$code = $_GET["code"];

$dsn = "mysql:host=mysql78.conoha.ne.jp;dbname=9adb7_cmp_02_db;charset=utf8";
$user = "9adb7_ybf_cmp_02";
$password = "gX+ibjR3-bPk";
$dbh = new PDO($dsn, $user, $password);
$dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = "SELECT code, name, price, gazou, explanation FROM product WHERE code=?";
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
    print "<a href='../member_login/member_login.php'>ログイン画面へ</a>";
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
    </div>

    <div class="right">
        <div><img class="ad-img" src="../product/gazou/adv-1.png" alt="#"></div>
        <div><img class="ad-img" src="../product/gazou/adv-2.png" alt="#"></div>
        <div><img class="ad-img" src="../product/gazou/adv-3.jpg" alt="#"></div>
    </div>
</main>

</body>
</html>