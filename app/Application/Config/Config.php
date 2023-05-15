<?php

namespace App\Application\Config;

use Codin\Dot\Dot;

class Config implements ConfigInterface
{
    public const IGNORE_FILES = ['..', '.'];
    private static array $config;

    //метод создает обьект класса Dot(подключен пакет), в который помещается
    //массив с ???  , и вызывая в данном случае метод get(app.exception_view) получаем нужное значение
    public static function get(string $key): mixed
    {
        $dot = new Dot((self::$config));
        return $dot->get($key);
    }

    public static function init(): void
    {
        $path = __DIR__ . '/../../../config';
        //возвращает список файлов в виде массива в указанной дирректории
        $files = scandir($path);
        //отфильтровываем массив, т.к. получаем в нем лишние элементы - точки
        //обходит каждое значение массива, если функция true - удаляет
        $files = array_filter($files, function ($file) {
            return !in_array($file, self::IGNORE_FILES);
        });
        //перебирается массив и подключаются файлы с конфирурацией
        foreach ($files as $file) {
            $data = include "$path/$file";
            //если нет массива, то он добавляться не будет
            //basename убирает .php, получается ключ с названием файла
            if (is_array($data)) {
                self::$config[basename($file, '.php')] = $data;
            }
        }
    }
}