<?php

require_once "../common/layout.php";
require_once("../common/common.php");

$post = sanitize($_POST);

$email = $post["email"];
$pass = $post["pass"];
$pass2 = $post["pass2"];
$okflag = true;

print "<main class='main'>";
print "<div class='left'>";

if(empty($email) === true) {
    print "emailを入力してください。<br>";
    $okflag = false;
}
if(preg_match("/\A[\w\-\.]+\@[\w\-\.]+\.([a-z]+)\z/", $email) === 0) {
    print "正しいemailを入力してください。<br>";
    $okflag = false;
}
if(empty($pass) === true) {
    print "パスワードを入力してください。<br>";
    $okflag = false;
}
if($pass != $pass2) {
    print "パスワードが異なります<br>";
    $okflag = false;
}
if($okflag === false) {
    print "<form><br>";
    print "<input type='button' onclick='history.back()' value='戻る'>";
} else {
    print "下記mailアドレスでログインしますか？<br><br>";
    print $email."<br><br>";
    print "<form action='member_login_done.php' method='post'>";
    print "<input type='hidden' name='email' value='".$email."'>";
    print "<input type='hidden' name='pass' value='".$pass."'>";
    print "<input type='button' onclick='history.back()' value='戻る'>";
    print "<input type='submit' value='ログイン'>";
}
?>
    </div>
    <br><br>
    <div class="right">
        <div><img class="ad-img" src="../product/gazou/adv-1.png" alt="#"></div>
        <div><img class="ad-img" src="../product/gazou/adv-2.png" alt="#"></div>
        <div><img class="ad-img" src="../product/gazou/adv-3.jpg" alt="#"></div>
    </div>
</main>

</body>
</html>