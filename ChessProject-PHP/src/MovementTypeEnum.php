<?php
namespace LogicNow;
use MyCLabs\Enum\Enum;

class MovementTypeEnum extends Enum
{
    const MOVE = 'MOVE';
    const CAPTURE = 'CAPTURE';

    public static function MOVE()
    {
        return new MovementTypeEnum(self::MOVE);
    }

    public static function CAPTURE()
    {
        return new MovementTypeEnum(self::CAPTURE);
    }
}
