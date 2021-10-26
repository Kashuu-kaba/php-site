<?php
require_once "../common/layout.php";

    try{

require_once("../common/common.php");

$post = sanitize($_POST);

$email = $post["email"];
$pass = $post["pass"];

$pass = md5($pass);

$dsn = "mysql:host=localhost;dbname=shop;charset=utf8";
$user = "root";
$password = "root";
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

</body>
</html>