<?php

namespace src\class;
use PDO;

// Класс для работы с таблицей "order_product", который наследуется от абстрактного класса Database
class OrderProduct extends Database
{
    // Конструктор, который вызывает родительский конструктор с именем таблицы
    public function __construct(PDO $pdo)
    {
        parent::__construct($pdo, 'order_product');  // Передаем имя таблицы "order_product"
    }
}
