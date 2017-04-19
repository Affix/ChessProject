<?php
namespace LogicNow;
use MyCLabs\Enum\Enum;

class PieceColorEnum extends Enum
{
    const BLACK = 'BLACK';
    const WHITE = 'WHITE';

    public static function BLACK()
    {
        return new PieceColorEnum(self::BLACK);
    }

    public static function WHITE()
    {
        return new PieceColorEnum(self::WHITE);
    }
}
