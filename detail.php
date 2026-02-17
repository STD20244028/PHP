<?php session_start(); ?>
<! DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>メインページ</title>
<link rel="stylesheet" href="../style.css">
<link rel="stylesheet" href="style.css">
</head>
<body>
<?php require 'header.php' ?>
<h2>ようこそ<?= $_SESSION['dname']?>さん</h2>
<form action="cart.php" method="post">
購入数：<input type="text" name ="count">
<input type="submit" value="カートに追加">
<input type="hidden" name="pid" value="<?=$_GET['id']?>">
</form>
<table>
<tr><th>商品番号</th><th>商品名</th><th>価格</th></tr>
<?php
$pdo = new PDO('mysql:host=localhost;dbname=r2a12521;charset=utf8','r2a12521','20050602');
$sql=$pdo->prepare('select*from products where p_id=?');
$sql->execute([$_GET['id']]);
foreach ($sql as $row){
?>
	<tr>
	<td><?= $row['p_id'] ?></td>
	<td><?= $row['p_name'] ?> </td>
	<td><?= $row['p_price'] ?></td>
	</tr>

<?php
}
?>

</table>
<img alt="image" src="image/<?= $_GET['id'] ?>.jpg">
</body>
</html>