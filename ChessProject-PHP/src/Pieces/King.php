<?php

namespace LogicNow\Pieces;


use LogicNow\Piece;
use LogicNow\MovementTypeEnum;


class King extends Piece
{

    const MAX_COUNT = 1;
    const MOVE_LIMIT = 1;

    public function move(MovementTypeEnum $movementTypeEnum, $newX, $newY)
    {
        $old_x = $this->getXCoordinate();
        $old_y = $this->getYCoordinate();

        if(abs($old_x - $newX) <= self::MOVE_LIMIT &&
           abs($old_y - $newY) <= self::MOVE_LIMIT)
        {
          $this->setYCoordinate($newY);
          $this->setXCoordinate($newX);
        }
    }
}
