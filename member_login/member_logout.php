<?php
session_start();
$_SESSION = array();
if(isset($_Cookie[session_name()]) === true) {
    setcookie(session_name(), "", time()-42000, "/");
}
session_destroy();

require_once "../common/layout.php";
?>

<main class='main'>
<div class='left'>

ログアウトしました。

<br><br>
<a href="../shop/shop_list.php">TOPへ</a>
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