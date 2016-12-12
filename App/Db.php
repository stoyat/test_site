<?php

namespace App;

use App\Exceptions\Database;
use App\Exceptions\DbException;

class Db
{
    use TSingleton;

    protected $dbh;

    protected function __construct()
    {
        $config = Config::getInstance()->data['db'];
        try {
            $this->dbh = new \PDO('mysql:host=' . $config['host'] .
                ';dbname=' . $config['dbname'],
                $config['user'],
                $config['password']);
        }catch (\PDOException $e) {
            throw new DbException($e->getMessage());
        }

    }

    /**
     * Запускает подготовленный запрос на выполнение этот метод ничео не возвращает
     *
     * @param string $sql
     * @param array $data
     * @return bool
     */
    public function execute(string $sql, array $data = [])
    {
        //подготовка запроса
        $sth = $this->dbh->prepare($sql);
        //выполнение
        $result = $sth->execute($data);
        if (false === $result) {
            throw new DbException('Ошибка запроса к БД');
            die;
        }
        return true;
    }

    /**
     * @param string $sql
     * @param array $data массив подстановок
     * @param null $class
     * @return array,obj
     */
    public function query(string $sql, array $data = [], $class = null)
    {
        $sth = $this->dbh->prepare($sql);
        $result = $sth->execute($data);
        if (false === $result) {
            throw new DbException('Ошибка запроса к БД');
            die;
        }
        if (null === $class) {
            return $sth->fetchAll();
        } else {
            return $sth->fetchAll(\PDO::FETCH_CLASS, $class);
        }
    }

    /**
     * @return string
     */

    public function lastInsertId()
    {
        return $this->dbh->lastInsertId();
    }

}