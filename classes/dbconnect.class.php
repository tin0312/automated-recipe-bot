<?php

use Dotenv\Dotenv;

require __DIR__ . '/../vendor/autoload.php';

// Load .env from the project root
$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();



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
        // Use provided values or fall back to environment variables
        $this->host = $host ?? $_ENV['DB_HOST'];
        $this->user = $user ?? $_ENV['DB_USER'];
        $this->pass = $pass ?? $_ENV['DB_PASS'];
        $this->db = $db;
        $this->port = $port ?? (int) ($_ENV['DB_PORT'] ?? 3306);

        // Debug output
        echo "Final values:<br>";
        echo "Host: " . $this->host . "<br>";
        echo "User: " . $this->user . "<br>";
        echo "Password: " . (empty($this->pass) ? '[empty]' : '[set]') . "<br>";
        echo "Port: " . $this->port . "<br>";
        echo "Database: " . $this->db . "<br>";
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
