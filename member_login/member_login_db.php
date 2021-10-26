<?php
require_once "../common/layout.php";
?>

新規会員登録画面<br><br>

お名前<br>
<form action="member_login_db_check.php" method="post">
<input type="text" name="name">
<br>
email<br>
<input type="text" name="email">
<br>
住所<br>
<input type="text" name="address">
<br>
tel<br>
<input type="text" name="telephone">
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

</form>
<br><br>

</body>
</html>