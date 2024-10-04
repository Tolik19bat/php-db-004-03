<?php

namespace src\class;
use PDO;

// Класс для работы с таблицей "client", который наследуется от абстрактного класса Database
class Client extends Database
{
    // Конструктор, который вызывает родительский конструктор с именем таблицы
    public function __construct(PDO $pdo)
    {
        parent::__construct($pdo, 'client');  // Передаем имя таблицы "client"
    }
}
