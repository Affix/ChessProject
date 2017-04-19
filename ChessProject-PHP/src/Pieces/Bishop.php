<?php

namespace LogicNow\Pieces;


use LogicNow\Piece;
use LogicNow\MovementTypeEnum;
use LogicNow\PieceColorEnum;
use LogicNow\Pieces\MovementValidator\BishopMovementValidator;

class Bishop extends Piece
{

    const MAX_COUNT = 2;

    public function __construct(PieceColorEnum $pieceColorEnum)
    {
      parent::__construct($pieceColorEnum, new BishopMovementValidator());
    }

    public function move(MovementTypeEnum $movementTypeEnum, $newX, $newY)
    {
      if($this->_validator->validate($this, $newX, $newY, $movementTypeEnum))
      {
        $this->setYCoordinate($newY);
        $this->setXCoordinate($newX);
      }
    }
}
