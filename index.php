<?php

use src\class\Shop;

require_once 'autoload.php';

try {
    // Подключение к базе данных SQLite
    $pdo = new PDO('identifier.sqlite');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Работаем с таблицей "shop"
    $shop = new Shop($pdo);

    // Вставка новой записи в таблицу "shop"
    $newShop = $shop->insert(['name', 'address'], ['Магазин 1', 'Улица 123']);
    print_r($newShop); // Вывод добавленной записи

    // Обновление записи в таблице "shop"
    $updatedShop = $shop->update($newShop['id'], ['name' => 'Новый Магазин']);
    print_r($updatedShop);  // Вывод обновленной записи

    // Поиск записи по ID
    $foundShop = $shop->find($newShop['id']);
    print_r($foundShop);  // Вывод найденной записи

    // Удаление записи
    $shop->delete($newShop['id']);
    echo "Запись удалена\n";

} catch (PDOException $e) {
    echo "Ошибка: " . $e->getMessage();
}
