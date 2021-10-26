<?php
session_start();
$_SESSION = array();
if(isset($_Cookie[session_name()]) === true) {
    setcookie(session_name(), "", time()-42000, "/");
}
session_destroy();

require_once "../common/layout.php";
?>


ログアウトしました。

<br><br>
<a href="../shop/shop_list.php">TOPへ</a>
<br><br>

</body>
</html>