<?php
try {
    $pdo = new PDO('sqlite:identifier.sqlite');
    echo "SQLite успешно подключен!";
} catch (PDOException $e) {
    echo "Ошибка подключения: " . $e->getMessage();
}
