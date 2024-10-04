<?php

namespace src\class;
use PDO;

// Класс для работы с таблицей "product", который наследуется от абстрактного класса Database
class Product extends Database
{
    // Конструктор, который вызывает родительский конструктор с именем таблицы
    public function __construct(PDO $pdo)
    {
        parent::__construct($pdo, 'product');  // Передаем имя таблицы "product"
    }
}
