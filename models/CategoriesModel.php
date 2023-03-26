<?php

require_once '../core/Model.php';

class CategoriesModel extends Model
{
    public function getCategories()
    {
        $sql = "SELECT * FROM categories where status = 1";
        $result = $this->db->query($sql);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCategory($id)
    {
        $sql = "SELECT * FROM categories where id_categories = $id";
        $result = $this->db->query($sql);
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public function updateCategory($id, $name, $observations)
    {
        $sql = "UPDATE categories SET name = :name, observations = :observations WHERE id_categories = :id";
        $result = $this->db->prepare($sql);
        $result->bindValue(':id', (int) $id, PDO::PARAM_INT);
        $result->bindValue(':name', (string) $name, PDO::PARAM_STR);
        $result->bindValue(':observations', (string) $observations, PDO::PARAM_STR);
        $result->execute();
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public function createCategory($name, $observations)
    {
        $sql = "INSERT INTO categories (name, observations, status) VALUES (:name, :observations, 1)";
        $result = $this->db->prepare($sql);
        $result->bindValue(':name', (string) $name, PDO::PARAM_STR);
        $result->bindValue(':observations', (string) $observations, PDO::PARAM_STR);
        $result->execute();
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public function deleteCategory($id)
    {
        $sql = "UPDATE categories SET status = 0 WHERE id_categories = :id";
        $result = $this->db->prepare($sql);
        $result->bindValue(':id', (int) $id, PDO::PARAM_INT);
        $result->execute();
        return $result->fetch(PDO::FETCH_ASSOC);
    }
}
