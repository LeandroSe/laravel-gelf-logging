<?php

namespace LeandroSe\LaravelGelfLogging\Processors;

class HashProcessor
{

    private static $hash = false;


    /**
     * Transform a "NULL" string record into a null value.
     *
     * @param array $record
     * @return array
     */
    public function __invoke(array $record): array
    {
        if (!self::$hash) {
            self::$hash = uniqid();
        }
        $record['message'] = sprintf('[%s] %s', self::$hash, $record['message']);

        return $record;
    }
}
