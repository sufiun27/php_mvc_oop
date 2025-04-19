<?php

trait Database
{
    private string $dbType = 'mysql'; // Change to 'mssql' to switch

    private function connect(): PDO
    {
        $host = 'localhost';
        $dbname = 'mvc_oop';
        $username = 'root';         // Use your MSSQL username if needed
        $password = '';             // MSSQL password here too
        $charset = 'utf8mb4';

        try {
            if ($this->dbType === 'mysql') {
                $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
            } elseif ($this->dbType === 'mssql') {
                $dsn = "sqlsrv:Server=$host;Database=$dbname";
            } else {
                throw new Exception("Unsupported DB type: {$this->dbType}");
            }

            return new PDO($dsn, $username, $password, [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ]);

        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public function query(string $query, array $data = []): array|false
    {
        $con = $this->connect();
        $stmt = $con->prepare($query);
        $success = $stmt->execute($data);

        if ($success) {
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result ?: false;
        }

        return false;
    }
}

/**
 * MSSQL PDO Driver Notes:
 *
 * To use MSSQL with PDO in PHP:
 *
 * 1. Use the `sqlsrv` driver.
 * 2. Make sure the Microsoft SQL Server Driver for PHP is installed.
 *    - For Windows: Download from Microsoft
 *      https://learn.microsoft.com/en-us/sql/connect/php/download-drivers-php-sql-server
 *
 * 3. Enable the driver in your php.ini file:
 *
 *!    extension=php_pdo_sqlsrv.dll
 *!    extension=php_sqlsrv.dll
 *
 * 4. Restart your web server (e.g., Apache, Nginx, or PHP built-in server).
 *
 * Note:
 * - `sqlsrv` only works on Windows OS with SQL Server.
 * - For Linux, use `dblib` with FreeTDS (dsn: dblib:host=localhost;dbname=your_db).
 */
