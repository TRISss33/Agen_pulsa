<?php
require 'functions.php';
$pdo = pdo_connect_mysql();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare('DELETE FROM agen_pulsa WHERE id = ?');
    $stmt->execute([$id]);

    header('Location: index.php');
} else {
    exit('No ID specified.');
}
?>
