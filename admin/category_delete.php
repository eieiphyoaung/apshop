<?php
require '../config/config.php';
require '../config/common.php';

$stmt = $pdo->prepare("DELETE FROM categories WHERE id=".$_GET['id']);
$stmt->execute();
header('Location: category.php');
?>