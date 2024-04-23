<?php

namespace App\Models;

use Core\Database;

class Jiri extends Database
{
    protected string $table = 'jiris';

    public function upcomingBelongingTo(string|int $id, string $model_name): false|array
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

    public function pastBelongingTo(string|int $id, string $model_name): false|array
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

    public function fetchContacts(string|int $id): false|array
    {
        $sql = <<<SQL
            SELECT * FROM attendances
            LEFT JOIN jiri.contacts c on attendances.contact_id = c.id
            WHERE jiri_id = :id
            ORDER BY c.name;
        SQL;

        $statement = $this->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();
        return $statement->fetchAll();
    }

}
