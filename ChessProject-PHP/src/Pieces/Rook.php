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
        throw("Impliment Rook::Move");
    }
}
