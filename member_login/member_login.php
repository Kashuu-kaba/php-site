<?php
require_once "../common/layout.php";
?>

<main class='main'>
    <div class='left'>
      会員情報を入力してください。
      <br><br>
      mailアドレス<br>
      <form action="member_login_check.php" method="post">
        <input type="text" name="email">
        <br>
        パスワード<br>
        <input type="password" name="pass">
        <br>
        パスワード再入力<br>
        <input type="password" name="pass2">
        <br><br>
        <input type="button" onclick="history.back()" value="戻る">
        <input type="submit" value="OK">
        <br><br>
        会員情報が未登録の方はこちらから登録をお願いします。<br>
        <a href="./member_login_db.php">会員登録画面へ</a>
      </form>
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