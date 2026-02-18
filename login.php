<?php session_start(); ?>
<! DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title> </title>
<link rel="stylesheet" href="../style.css">
<link rel="stylesheet" href="style.css">
</head>
<body>
<?php
unset($_session['id']);
$pdo = new PDO('mysql:host=localhost;dbname=gakusei;charset=utf8','gakuseki','20050602');
$sql=$pdo->prepare('select * from users where u_name=? and u_pass=?');
$sql->execute([$_POST['user'],$_POST['pass']]);
foreach ($sql as $row){
	$_SESSION['id'] = $row['u_id'];
	$_SESSION['dname'] = $row['u_dname'];
}
if(isset($_SESSION['id'])){
	header('Location:main.php');
	exit();
}else{
	header('Location:index.php');
	exit();
}

?>
</body>
</html>
