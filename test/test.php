<?php

require_once __DIR__ . '/../autoload.php';
/**
 * execute
$test = new \App\Db();
//var_dump($test);
$result = $test->execute("CREATE TABLE news (id INTEGER ) ");
var_dump($result);
 */

/**
 * $article = \App\Model\Article::findAll();
var_dump($article);
 */

/**
 * insert
$article = new \App\Model\Article();
$article->title = 'test';
$article->article = 'testtest';
$article->insert();
 */

/**
$config = new \App\Config();
echo $config->data['db']['host'];
*/
/**
$config = \App\Config::getInstance();
echo $config->data['db']['host'];
*/

/**
 * update
$article = new \App\Model\Article();
$article->id = 6;
$article->title = 'Заголовок';
$article->article = 'Текст';
$article->save();
 */
/**
 * insert
$article = new \App\Model\Article();
$article->title = 'Заголовок';
$article->article = 'Текст';
$article->save();
 */
/*
$article = new \App\Model\Article();
$article->id = 6;
$article->delete();
*/
/**
$author = \App\Model\Article::findAll();
var_dump($author[0]->author);
*/
/**
$search = 'Самый';
$search = \App\Model\Article::getSearchMatch($search);
var_dump($search);
*/
/**
$search = 'Англ';
$search = \App\Model\Article::getSearchLike($search);
var_dump($search);

*/
/**

try {
    $csv = new \App\CSV("../blog.csv");
    $arr = \App\Model\Article::findByid(73);
    $csv->setCSV($arr);
}
catch (Exception $e) {
    echo "Ошибка: " . $e->getMessage();
}
*/









