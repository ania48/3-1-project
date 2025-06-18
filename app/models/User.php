<?php
class User
{
    private $db;

    public function __construct()
    {
        global $databaseConnection;
        $this->db = $databaseConnection;
    }

    public function findByName($name)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE name = ?");
        $stmt->bind_param("s", $name);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
    public function userExists($name)
    {
        global $databaseConnection;
        $stmt = $databaseConnection->prepare("SELECT id FROM users WHERE name = ?");
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }

    public function createUser($name, $email, $hashedPassword, $role)
    {
        global $databaseConnection;
        $stmt = $databaseConnection->prepare("INSERT INTO users (name, email, password_hash, role) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $hashedPassword, $role);
        $stmt->execute();
    }
}
