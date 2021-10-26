<?php

function sanitize($before) {
    foreach($before as $key => $value) {
        $after[$key] = htmlspecialchars($value, ENT_QUOTES,"UTF-8");
    }
    return $after;
}
function pulldown_cate() {
    print "<select name='cate'>";
    print "<option value='健康食品'>健康食品</option>";
    print "<option value='化粧品'>化粧品</option>";
    print "<option value='はちみつ食品'>はちみつ食品</option>";
    print "</select>";
}

?>