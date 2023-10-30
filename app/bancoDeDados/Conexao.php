<?php
class Conexao
{
    private static $instancia;
    private static $driver;
    private static $host;
    private static $database;
    private static $username;
    private static $password;

    public static function get()
    {
        try {
            if (!isset(self::$instancia)) {
                self::getDados();
                self::$instancia = new PDO(
                    self::$driver .
                    ':host=' . self::$host .
                    ';dbname=' . self::$database,
                    self::$username,
                    self::$password
                );
            }
            return self::$instancia;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    private static function getDados()
    {
        $dados = require 'config.php';
        self::$driver = $dados['driver'];
        self::$host = $dados['host'];
        self::$database = $dados['database'];
        self::$username = $dados['username'];
        self::$password = $dados['password'];
    }
}
