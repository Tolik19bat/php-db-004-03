<?php

namespace src\class;
use PDO;

// Класс для работы с таблицей "order", который наследуется от абстрактного класса Database
class Order extends Database
{
    // Конструктор, который вызывает родительский конструктор с именем таблицы
    public function __construct(PDO $pdo)
    {
        parent::__construct($pdo, 'order');  // Передаем имя таблицы "order"
    }
}
