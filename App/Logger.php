<?php
/**
 * Created by PhpStorm.
 * User: Evgeniy
 * Date: 30.10.2016
 * Time: 9:25
 */

namespace App;


class Logger
{
    use TSingleton;

    protected $filePath = __DIR__ . '/../loger/errors.log';

    public function log(\Exception $e)
    {
        $message = 'Время:' . date("Y-m-d H:i:s") . ' Ошибка: '. $e->getCode() . ' Путь к файлу: ' . $e->getFile() .
            ' На строчке ' . $e->getLine() . ' Сообщение о ошибке: ' . $e->getMessage() . PHP_EOL;
        file_put_contents($this->filePath , $message, FILE_APPEND);
    }
}