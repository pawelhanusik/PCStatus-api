<?php

namespace App\Enums;

class TaskStatusEnum {
    public const CREATED = 'created';
    public const STARTED = 'started';
    public const RUNNING = 'running';
    public const DONE = 'done';

    public static function toArray()
    {
        return [
            self::CREATED,
            self::STARTED,
            self::RUNNING,
            self::DONE,
        ];
    }
}
