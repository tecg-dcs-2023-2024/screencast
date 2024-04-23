<?php

namespace App\Models;

use Core\Database;

class Jiri extends Database
{
    protected string $table = 'jiris';

    public function upcomingBelongingTo(int $id, string $model_name): false|array
    {
        $foreign_key = "{$model_name}_id";
        $sql = <<<SQL
                SELECT * FROM $this->table
                         WHERE $foreign_key = :id   
                               AND starting_at > current_timestamp
                SQL;
        $statement = $this->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function pastBelongingTo(int $id, string $model_name): false|array
    {
        $foreign_key = "{$model_name}_id";
        $sql = <<<SQL
                SELECT * FROM $this->table
                         WHERE $foreign_key = :id   
                               AND starting_at < current_timestamp
                SQL;
        $statement = $this->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();
        return $statement->fetchAll();
    }

}
