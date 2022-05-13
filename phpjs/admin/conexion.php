<?php
class Database
{
    private $host;
    private $db;
    private $user;
    private $password;
    private $char;
    public function __construct()
    {
        $this->host = 'localhost';
        $this->db = 'olwpays';
        $this->user = 'root';
        $this->password = '';
        $this->char = 'utf8mb4';
    }
    function connect()
    {
        try
        {
            $connection=
            "mysql:host=".$this->host.
            ";dbname=".$this->db.
            ";charset=".$this->char;
            $options=[
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];
            $pdo=new PDO($connection, $this->user, $this->password, $options);
            return $pdo;
        }
        catch(PDOException $e)
        {
            print_r('ERROR DE CONEXION'.$e->getMessage());
        }            
        
    }
}
?>