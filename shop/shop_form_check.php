<?php

session_start();
session_regenerate_id(true);

require_once "../common/layout.php";

if(isset($_SESSION["member_login"]) === false) {
    print "ログインしてく下さい。<br><br>";
    print "<a href='../member_login/member_login.php'>ログイン画面へ<br><br></a>";
    print "<a href='shop_list.php'>TOP画面へ</a>";
}
    if(isset($_SESSION["member_login"]) === true) {
    print "ようこそ";
    print $_SESSION["member_name"];
    print "様　";
    print "<a href='../member_login/member_logout.php'>ログアウト</a>";
    print "<br><br>";
    }


    print "購入確認画面";
    print "　<a href='shop_cartlook.php'>カートを見る</a>";
    print "<br><br>";


print "<main class='main'>";
print "<div class='left'>";

try {

$menber_code = $_SESSION["member_code"];
$cart = $_SESSION["cart"];
$kazu = $_SESSION["kazu"];
$max = count($kazu);

$dsn = "mysql:host=mysql78.conoha.ne.jp;dbname=9adb7_cmp_02_db;charset=utf8";
$user = "9adb7_ybf_cmp_02";
$password = "gX+ibjR3-bPk";
$dbh = new PDO($dsn, $user, $password);
$dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = "SELECT name, email, address, telephone FROM member WHERE code=?";
$stmt = $dbh -> prepare($sql);
$data[] = $menber_code;
$stmt -> execute($data);

$rec = $stmt -> fetch(PDO::FETCH_ASSOC);

print "下記内容でよろしいでしょうか？<br><br>";
print "【宛先】<br>";
print "お名前:".$rec['name']."様<br>";
print "mail:".$rec['email']."<br>";
print "ご住所:".$rec['address']."<br>";
print "ご連絡先:".$rec['telephone']."<br><br>";
$name = $rec["name"];
$email = $rec["email"];
$address = $rec["address"];
$tel = $rec["tel"];

print "【ご注文内容】<br>";
for($i = 0; $i < $max; $i++) {
  $sql = "SELECT name, price, gazou FROM mst_product WHERE code=?";
  $stmt = $dbh -> prepare($sql);
  $data = array();
  $data[] = $cart[$i];
  $stmt -> execute($data);

$rec = $stmt -> fetch(PDO::FETCH_ASSOC);

if(empty($rec["gazou"]) === true) {
$disp_gazou = "";
} else {
$disp_gazou = "<img class='img' src='../product/gazou/".$rec['gazou']."'>";
}
print "<div class='box'>";
print "<div class='list'>";
print "<div class='img'>";
print $disp_gazou;
print "</div>";
print "<div class='npe'>";
print "商品名:".$rec['name']."<br>";
print "価格:".$rec['price']."円　<br>";
print "数量:".$kazu[$i]."<br>";
print "合計価格:".$rec['price'] * $kazu[$i]."円<br><br>";
$goukei[] = $rec['price'] * $kazu[$i];
print "</div></div></div><br>";
}
$dbh = null; 
print "【ご請求金額】---".array_sum($goukei)."円<br><br>";
print "<form action='shop_form_done.php' method='post'>";
print "<input type='hidden' name='name' value='".$name."'>";
print "<input type='hidden' name='email' value='".$email."'>";
print "<input type='hidden' name='address' value='".$address."'>";
print "<input type='hidden' name='telephone' value='".$tel."'>";
print "<input type='button' onclick='history.back()' value='戻る'>";
print "<input type='submit' value='OK'>";
print "</form>";
}

catch(Exception $e) {
    print "只今障害が発生しております。<br><br>";
    print "<a href='../member_login/member_login.php'>ログイン画面へ</a>";
}
?>
</div>
   <div class="right">
        <div><img class="ad-img" src="../product/gazou/adv-1.png" alt="#"></div>
        <div><img class="ad-img" src="../product/gazou/adv-2.png" alt="#"></div>
        <div><img class="ad-img" src="../product/gazou/adv-3.jpg" alt="#"></div>
    </div>
</main>
</body>
</html>