<?php
class DbConnect
{
    private string $host;
    private string $user;
    private string $pass;
    private string $db;
    private int $port;
    private ?PDO $conn = null;

    public function __construct(
        string $db,
        ?string $host = null,
        ?string $user = null,
        ?string $pass = null,
        ?int $port = null
    ) {
        $this->host = $host ?? getenv('DB_HOST');
        $this->user = $user ?? getenv('DB_USER');
        $this->pass = $pass ?? getenv('DB_PASS');
        $this->db = $db;
        $this->port = $port ?? (int) (getenv('DB_PORT') ?: 3306);
    }

    public function connect(): PDO
    {
        if ($this->conn === null) {
            $dsn = "mysql:host={$this->host};port={$this->port};dbname={$this->db};charset=utf8mb4";
            try {
                $this->conn = new PDO($dsn, $this->user, $this->pass, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]);
            } catch (PDOException $e) {
                die("Database connection failed: " . $e->getMessage());
            }
        }
        return $this->conn;
    }
}
