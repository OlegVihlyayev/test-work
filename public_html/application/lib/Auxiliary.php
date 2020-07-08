<?php

namespace application\lib;


class Auxiliary
{

    // Получает длину строки в зависимости от кодировки
    public static function strlenDifferentCoding($str)
    {
        $str = trim($str);
        if (!empty($str)) {
            return $rezult = (mb_detect_encoding($str) == "UTF-8") ? mb_strlen($str) : iconv_strlen($str);
        } else {
            return 0;
        }

    }

// Фильтрация HTML-сущностей , избыточных пробелов
    public static function getPreparedText($str)
    {
        $str = trim($str);
        return htmlentities($str);
    }

}