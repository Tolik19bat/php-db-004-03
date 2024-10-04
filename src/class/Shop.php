<?php

namespace src\class;
use PDO;

// Класс для работы с таблицей "shop", который наследуется от абстрактного класса Database
class Shop extends Database
{
    // Конструктор, который вызывает родительский конструктор с именем таблицы
    public function __construct(PDO $pdo)
    {
        parent::__construct($pdo, 'shop');  // Передаем имя таблицы "shop"
    }
}
