<?php

namespace App;

use App\Exceptions\MultiException;

abstract class Model
{
    public static $table;
    public $id;
    const LIMMIT = 2;

    /**
     * @param $search
     * @return mixed
     */
    public static function getSearchLike($search)
    {
        $db = DB::getInstance();
        $data = $db->query(
            'SELECT * FROM ' . static::$table . " WHERE title LIKE '%$search%'" ,
            [],
            static::class
        );
        return $data;
    }

    /**
     * @return mixed
     *get count record in DB
     */
    public static function getTotal()
    {
        $db = DB::getInstance();
        $data = $db->query(
            'SELECT COUNT(id) AS count FROM ' . static::$table,
            [],
            static::class
        );
        return $data[0];

    }

    /**
     * @param int $page
     * @return mixed
     * get data for pagination
     */
    public static function getOffset($page=1)
    {
       $offset = ($page -1)*self::LIMMIT;

        $db = DB::getInstance();
        $data = $db->query(
            'SELECT * FROM ' . static::$table . ' LIMIT '.self::LIMMIT . ' OFFSET ' . $offset,
            [],
            static::class
        );
        return $data;
    }

    /**
     * @param $field
     * @return mixed
     *
     */
    public static function findBySort($field)
    {
        $db = DB::getInstance();
        $data = $db->query(
            'SELECT * FROM ' . static::$table . ' ORDER BY '. $field . ' DESC',
            [],
            static::class
        );
        return $data;
    }

    /**
     * @return array
     * get all
     * находит в базе по публ своству поле и по ключу пресваивает
     */
    public static function findAll()
    {
        $db = DB::getInstance();
        $data = $db->query(
            'SELECT * FROM ' . static::$table,
            [],
            static::class
        );
        return $data;
    }

    /**
     * @param $id
     * @return bool
     * get 1 obj
     */
    public static function findByid($id)
    {
        $db = DB::getInstance();
        $data = $db->query(
            'SELECT * FROM ' . static::$table . ' WHERE id=:id',
            [':id' => $id],
            static::class
        );
        return $data[0] ?? false;
    }

    /**
     * selection insert or update
     */
    public function save ()
    {
        if (empty($this->id)) {
            $this->insert();
        } else {
            $this->update();
        }
    }

    /**
     * insert into db
     */
    public function insert()
    {
            $columns = [];
            $binds = [];
            $data = [];
            foreach ($this as $column => $value) {
                if ('id' == $column) {
                    continue;
                }
                $columns[] = $column;
                $binds[] = ':' . $column;
                $data[':' . $column] = $value;
            }
            $sql = '
                INSERT INTO ' . static::$table . '
                (' . implode(', ', $columns). ')
                VALUES
                (' . implode(', ', $binds). ')
                ';
            $db = DB::getInstance();
            $db->execute($sql, $data);
            $this->id = $db->lastInsertId();
    }

    /**
     * update obj
     */
    public function update()
    {
            $columns = [];
            $data = [];
            foreach ($this as $item => $value) {
                if ('id' == $item) {
                    continue;
                }
                $columns[] = $item . ' = ' . ':' . $item;
                $data[':' . $item] = $value;
            }
            $sql = '
                UPDATE ' . static::$table . '
                SET ' . implode(',', $columns) .
                ' WHERE id = :id';
                $data[':id'] = $this->id;
            $db = DB::getInstance();
            $db->execute($sql, $data);
    }

    /**
     * @param $id
     */
    public function delete()
    {
        $sql = '
            DELETE FROM ' . static::$table . '
            WHERE id=:id';
        $data[':id'] = $this->id;
        $db = DB::getInstance();
        $db->execute($sql, $data);
    }
}

