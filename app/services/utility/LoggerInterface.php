<?php
namespace App\services\utility;

interface LoggerInterface
{
    public function debug($message, $data);
    public function info($message, $data);
    public function warning($message, $data);
    public function error($message, $data);
}

