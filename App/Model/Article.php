<?php

namespace App\Model;

use App\Db;
use App\Model;

class Article
    extends Model
{
    public static $table = 'news';
    public $id;
    public $title;
    public $article;
    public $img;
    public $author_id;

    /*
     * return count - LIMITED article
     */
    public static function getLastnews($limit)
    {
        $db = DB::getInstance();
        $data = $db->query(
            'SELECT * FROM ' . static::$table . ' ORDER BY `id` DESC LIMIT ' . $limit,
            [],
            static::class
        );
        return $data;
     }

    /**
     * @param $name
     * @return bool|null
     */
    public function __get($name)
    {
        switch($name) {
            case 'author':
                return  Author::findByid($this->author_id);
                break;
            default:
                return null;
        }
    }

    public function __isset($name)
    {
        switch($name) {
            case 'author':
                return true;
                break;
            default:
                return null;
        }
    }
}
