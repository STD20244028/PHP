<?php
 if($_SESSION['id'] == null || $_SESSION['id'] == ""){
    header('Location:index.php');
    exit;
}
?>
<div>
<h1>応用商店</h1>
ユーザ名：<?= $_SESSION['dname'] ?><br>
<input type="submit" onclick="location.href='./main.php'" value="トップ"/>
<input type="submit" onclick="location.href='./logout.php'" value="ログアウト"/>
</div>