<?php

namespace App\Application\Database;
//операции для всех БД(добавление, удаление и тд.
class Model extends Connection implements ModelInterface
{
    protected int $id;
    protected ?string $created_at;
    protected ?string $updated_at;
    protected array $fields = [];
    protected string $table;
    protected array $collection = [];

    public function createdAt(): string
    {
        return $this->created_at;
    }

    public function updatedAt(): string
    {
        return $this->updated_at;
    }

    public function find(string $column, mixed $value, bool $many = false): array|bool|Model
    {
        $query = "SELECT * FROM `$this->table` WHERE `$column` = :$column";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute([$column => $value]);

        if ($many) {
            $items = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            foreach ($items as $item) {
                foreach ($item as $key => $value) {
                    $this->$key = $value;
                }
                $this->collection[] = clone $this;
            }
            return $this->collection;
        } else {
            $entity = $stmt->fetch(\PDO::FETCH_ASSOC);
            if (!$entity) {
                return false;
            }
            foreach ($entity as $key => $value) {
                $this->$key = $value;
            }
            return $this;
        }
    }

    //вставить в БД
    public function store(): void
    {
        //формируется строка из содержимого массива, array_map для добавления ковычек
        $columns = implode(', ', array_map(function ($field) {
            return "`$field`";
        }, $this->fields));

        $binds = implode(', ', array_map(function ($field) {
            return ":$field";
        }, $this->fields));

        $query = "INSERT INTO $this->table ($columns) VALUES ($binds)";
        $stmt = $this->connect()->prepare($query);

        //для execute
        $params = [];
        foreach ($this->fields as $field) {
            $params[$field] = $this->$field ?? null;
        }
        $stmt->execute($params);
    }

    public function update(array $data): void
    {
        $keys = array_keys($data);
        $fields = array_map(function ($item) {
            return "`$item` = :$item";
        }, $keys);
        $updatedFields = implode(',', $fields);
        $query = "UPDATE `$this->table` SET $updatedFields WHERE `users`.`id` = :id";
        $stmt = $this->connect()->prepare($query);
        $data['id'] = $this->id;
        $stmt->execute($data);
    }

    public function all(): array
    {
        $items = $this->connect()->query("SELECT * FROM `$this->table` ORDER BY id DESC")->fetchAll(\PDO::FETCH_ASSOC);
        foreach ($items as $item) {
            foreach ($item as $key => $value) {
                $this->$key = $value;
            }
            $this->collection[] = clone $this;
        }
        return $this->collection;
    }
}