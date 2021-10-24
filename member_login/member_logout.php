<?php
session_start();
$_SESSION = array();
if(isset($_Cookie[session_name()]) === true) {
    setcookie(session_name(), "", time()-42000, "/");
}
session_destroy();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ログアウト</title>
<link rel="stylesheet" href="../style.css">
</head>

<body>

ログアウトしました。

<br><br>
<a href="../shop/shop_list.php">TOPへ</a>
<br><br>

</body>
</html>