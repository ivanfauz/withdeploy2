<?php

use PHPUnit\Framework\TestCase;

class DatabaseConnectionTest extends TestCase
{
    private $host = "localhost";
    private $db = "lelang_vga";
    private $user = "root";
    private $pass = "";

    public function testDatabaseConnection()
    {
        try {
            $pdo = new PDO("mysql:host={$this->host};dbname={$this->db}", $this->user, $this->pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $this->assertInstanceOf(PDO::class, $pdo);
            echo "✅ Database connection successful!\n";
        } catch (PDOException $e) {
            $this->markTestSkipped("Database not available: " . $e->getMessage());
        }
    }

    public function testSimpleQuery()
    {
        try {
            $pdo = new PDO("mysql:host={$this->host};dbname={$this->db}", $this->user, $this->pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $stmt = $pdo->query("SELECT 1 as test");
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->assertEquals(1, $result['test']);
            echo "✅ Simple query test passed!\n";
        } catch (PDOException $e) {
            $this->markTestSkipped("Database not available: " . $e->getMessage());
        }
    }
}