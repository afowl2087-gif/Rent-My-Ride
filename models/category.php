<?php

require_once ROOT . '/config/database.php';

class Category
{
    private $pdo;

    private $Id_categories;
    private $nom_categorie;

    public function __construct()
    {
        $db = new Database();
        $this->pdo = $db->getConnection();
    }

    // GETTERS
    public function getId()
    {
        return $this->Id_categories;
    }

    public function getName()
    {
        return $this->nom_categorie;
    }

    // SETTERS
    public function setName($name)
    {
        $this->nom_categorie = $name;
    }

    // INSERT
    public function insert()
    {
        $sql = "INSERT INTO categories (nom_categorie) VALUES (:name)";
        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            'name' => $this->nom_categorie
        ]);
    }

    // GET ALL
    public function getAll()
    {
        $sql = "SELECT * FROM categories";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // UPDATE
    public function update($id, $name)
    {
        $sql = "UPDATE categories SET nom_categorie = :name WHERE Id_categories = :id";
        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            'id' => $id,
            'name' => $name
        ]);
    }

    // DELETE
    public function delete($id)
    {
        $sql = "DELETE FROM categories WHERE Id_categories = :id";
        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            'id' => $id
        ]);
    }

    // IS EXIST (bonus)
    public function isExist($name)
    {
        $sql = "SELECT * FROM categories WHERE nom_categorie = :name";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['name' => $name]);

        return $stmt->rowCount() > 0;
    }
}
