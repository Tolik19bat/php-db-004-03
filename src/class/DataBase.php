<?php

namespace src\class;

use src\interface\DatabaseWrapper;
use PDO;
// Абстрактный класс для работы с любой таблицей базы данных
abstract class Database implements DatabaseWrapper
{
    protected $pdo;     // Переменная для подключения к базе данных
    protected $table;   // Название таблицы

    // Конструктор класса, который принимает объект PDO и имя таблицы
    public function __construct(PDO $pdo, string $table)
    {
        $this->pdo = $pdo;   // Инициализация PDO
        $this->table = $table;   // Инициализация названия таблицы
    }

    // Вставка новой записи в таблицу
    public function insert(array $tableColumns, array $values): array
    {
        // Преобразование списка столбцов в строку
        $columns = implode(', ', $tableColumns);

        // Создание строк заполнителей для значений (?, ?, ?...)
        $placeholders = implode(', ', array_fill(0, count($values), '?'));

        // Подготовка SQL-запроса для вставки
        $sql = "INSERT INTO {$this->table} ({$columns}) VALUES ({$placeholders})";
        $stmt = $this->pdo->prepare($sql);  // Подготовка запроса
        $stmt->execute($values);  // Выполнение запроса

        // Получение ID последней вставленной записи
        $lastInsertId = $this->pdo->lastInsertId();

        // Возвращение результата, используя метод find
        return $this->find($lastInsertId);
    }

    // Обновление записи по ID
    public function update(int $id, array $values): array
    {
        // Преобразование массива значений в строку для SQL-запроса
        $setClause = implode(', ', array_map(fn($key) => "$key = ?", array_keys($values)));

        // Подготовка SQL-запроса для обновления записи
        $sql = "UPDATE {$this->table} SET {$setClause} WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);  // Подготовка запроса

        // Выполнение запроса с передачей значений и ID
        $stmt->execute(array_values($values + ['id' => $id]));

        // Возвращение обновленной записи
        return $this->find($id);
    }

    // Поиск записи по ID
    public function find(int $id): array
    {
        // Подготовка SQL-запроса для поиска записи по ID
        $sql = "SELECT * FROM {$this->table} WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);  // Подготовка запроса
        $stmt->execute([$id]);  // Выполнение запроса с передачей ID

        // Возвращение результата запроса в виде ассоциативного массива
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Удаление записи по ID
    public function delete(int $id): bool
    {
        // Подготовка SQL-запроса для удаления записи
        $sql = "DELETE FROM {$this->table} WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);  // Подготовка запроса

        // Выполнение запроса с передачей ID
        return $stmt->execute([$id]);
    }
}
