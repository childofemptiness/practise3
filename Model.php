<?php

require_once './Database.php';

class Model {

    protected $db;
    protected $table;

    public function __construct(Database $db) {
        
        $this->db = $db;
    }

    public function findAll() {

        $sql = "SELECT * FROM $this->table";

        $stmt = $this->db->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id) {

        $sql = "SELECT * FROM $this->table WHERE id = :id";

        $params = [

            'id' => $id,
        ];

        $stmt = $this->db->query($sql, $params);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function save($data) {

        $cols = implode(',', array_keys($data));

        $placeholder = ':' . implode(', :', array_keys($data));

        $sql = "INSERT INTO $this->table ($cols) VALUES ($placeholder)";

        return $this->db->query($sql, $data);
    }

    public function update($id, $data) {

        $set = '';

        foreach ($data as $key => $value) {

            $set .= "$key = :$key, ";
        }

        $set = rtrim($set, ', ');

        $data['id'] = $id;

        $sql = "UPDATE $this->table SET $set WHERE id = :id";

        return $this->db->query($sql, $data);
    }

    public function delete($id) {

        $sql = "DELETE FROM $this->table WHERE id = :id";

        $params = [
            
            'id' => $id,
        ];

        return $this->db->query($sql, $params);
    }
}
