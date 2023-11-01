<?php
class UserModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getUserByUsername($username) {
        $query = "SELECT * FROM usuarios WHERE usuario = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function createUser($nombre, $usuario, $contrasena, $id_cargo) {
        $hashedPassword = password_hash($contrasena, PASSWORD_DEFAULT);
        $query = "INSERT INTO usuarios (nombre, usuario, contraseña, id_cargo) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("sssi", $nombre, $usuario, $hashedPassword, $id_cargo);
        return $stmt->execute();
    }
}
?>
