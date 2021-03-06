<?php
session_start();
session_regenerate_id(true);

require_once "../common/layout.php";

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

?>

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

        <div class="box">
            <h3>カテゴリー</h3>
            <ul>
                <li><a href="shop_list_kenko.php">健康食品</a></li>
                <li><a href="shop_list_cosme.php">化粧品</a></li>
                <li><a href="shop_list_honey.php">はちみつ食品</a></li>
            </ul>
        </div>
    </div>

    <div class="right">
        <div><img class="ad-img" src="../product/gazou/adv-1.png" alt="#"></div>
        <div><img class="ad-img" src="../product/gazou/adv-2.png" alt="#"></div>
        <div><img class="ad-img" src="../product/gazou/adv-3.jpg" alt="#"></div>
    </div>
</main>

</body>

</html>