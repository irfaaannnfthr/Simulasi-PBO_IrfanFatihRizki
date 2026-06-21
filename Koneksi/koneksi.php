<?php
class Database {
    private string $host     = 'localhost';
    private string $dbname   = 'db_simulasi_pbo_trpl1a_irfanfatihrizki'; 
    private string $username = 'root';
    private string $password = '';
    private ?PDO $conn       = null;

    public function getConnection(): PDO {
        if ($this->conn === null) {
            try {
                $dsn = "mysql:host={$this->host};dbname={$this->dbname};charset=utf8";
                $this->conn = new PDO($dsn, $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                die("Koneksi gagal: " . $e->getMessage());
            }
        }
        return $this->conn;
    }
}