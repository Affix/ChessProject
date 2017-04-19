<?php

namespace LogicNow\Pieces;

use LogicNow\Piece;
use LogicNow\MovementTypeEnum;
use LogicNow\PieceColorEnum;
use LogicNow\Pieces\MovementValidator\KingMovementValidator;

class King extends Piece
{
    const MAX_COUNT = 1;
    const MOVE_LIMIT = 1;

    public function __construct(PieceColorEnum $pieceColorEnum)
    {
      parent::__construct($pieceColorEnum, new KingMovementValidator());
    }

    public function move(MovementTypeEnum $movementTypeEnum, $newX, $newY)
    {
        if($this->_validator->validate($this, $newX, $newY))
        {
          $this->setYCoordinate($newY);
          $this->setXCoordinate($newX);
        }
    }
}
