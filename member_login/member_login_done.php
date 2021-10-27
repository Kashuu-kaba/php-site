<?php
require_once "../common/layout.php";

    try{

require_once("../common/common.php");

print "<main class='main'>";
print "<div class='left'>";

$post = sanitize($_POST);

$email = $post["email"];
$pass = $post["pass"];

$pass = md5($pass);

$dsn = "mysql:host=mysql78.conoha.ne.jp;dbname=9adb7_cmp_02_db;charset=utf8";
$user = "9adb7_ybf_cmp_02";
$password = "gX+ibjR3-bPk";
$dbh = new PDO($dsn, $user, $password);
$dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = "SELECT code, name FROM member WHERE email=? AND password=?";
$stmt = $dbh -> prepare($sql);
$data[] = $email;
$data[] = $pass;
$stmt -> execute($data);

$dbh = null;

$rec = $stmt -> fetch(PDO::FETCH_ASSOC);

if(empty($rec["name"]) === true) {
    print "ログイン情報が間違っています。<br>";
    print "<a href='member_login.php'>戻る</a>";
    exit();
}
session_start();
$_SESSION["member_login"] = 1;
$_SESSION["member_name"] = $rec["name"];
$_SESSION["member_code"] = $rec["code"];
print "ログイン成功<br><br>";
print "<a href='../shop/shop_list.php'>トップへ戻る</a>";


}
catch(Exception $e) {
   print "只今障害が発生しております。";
   print "a href='member_login.php'>ログインページへ戻る</a>";
   exit();
}
?>
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