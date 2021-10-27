<?php
require_once "../common/layout.php";
try{

require_once("../common/common.php");


print "<main class='main'>";
print "<div class='left'>";

$post = sanitize($_POST);

$name = $post["name"];
$address = $post["address"];
$tel = $post["telephone"];
$email = $post["email"];
$pass = $post["pass"];

$pass = md5($pass);

$dsn = "mysql:host=mysql78.conoha.ne.jp;dbname=9adb7_cmp_02_db;charset=utf8";
$user = "9adb7_ybf_cmp_02";
$password = "gX+ibjR3-bPk";
$dbh = new PDO($dsn, $user, $password);
$dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = "SELECT email FROM member WHERE1";
$stmt = $dbh -> prepare($sql);
$stmt -> execute();

while(true) {
    $rec = $stmt -> fetch(PDO::FETCH_ASSOC);
    if(empty($rec) === true) {
        break;
    }
    $mail[] = $rec["email"];
}

if(empty($mail) === true) {
    $mail[] = "a";
}

if(in_array($email, $mail) === true) {
    print "すでに使われているmailアドレスです。<br><br>";
    print "<a href='member_login_db.php'>トップへ戻る</a>";
    $dbh = null;
} else {
$sql = "INSERT INTO member(name, email, address, telephone, password) VALUES(?,?,?,?,?)";
$stmt = $dbh -> prepare($sql);
$data[] = $name;
$data[] = $email;
$data[] = $address;
$data[] = $tel;
$data[] = $pass;
$stmt -> execute($data);

$dbh = null;


print "登録完了しました。<br><br>";
print "<a href='../shop/shop_list.php'>トップへ戻る</a>";

}
}
catch(Exception $e) {
   print "只今障害が発生しております。";
   print "<a href='member_login.php'>ログインページへ戻る</a>";
   echo 'DB接続エラー！: ' . $e->getMessage();
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