<?php
session_start();
session_regenerate_id(true);

require_once "../common/layout.php";
?>

    <main class="top-main">
            <div class="upper-left box"></div>
            <div class="upper-right box"></div>
            <div class="bottom-left box"></div>
            <div class="bottom-right box"></div>
            <a href="../shop/shop_list.php" class="top-title">
                <!-- <h1 class="top-title"> -->
                <h1>ようこそ<br>ホームページへ<br></h1>
                <p>↑上の文字をクリック</p>
                <!-- </h1> -->
            <!-- <p class="top-title">↑上の文字をクリック</p> -->
            </a>
            <!-- <a href="../shop/shop_list.php">リンク</a> -->
    </main>

</body>
</html>