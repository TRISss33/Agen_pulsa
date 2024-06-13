<?php
require 'functions.php';
$pdo = pdo_connect_mysql();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare('SELECT * FROM agen_pulsa WHERE id = ?');
    $stmt->execute([$id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode($row);
} else {
    echo json_encode(['error' => 'No ID specified']);
}
?>
