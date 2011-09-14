<?php
class Dumper extends CVarDumper
{
    public static function dump($var, $highlight = true, $depth = 10)
    {
        echo self::dumpAsString($var, $depth, $highlight);
    }
}
?>