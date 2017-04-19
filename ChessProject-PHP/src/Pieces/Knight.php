<?php

namespace LogicNow\Pieces;


use LogicNow\Piece;
use LogicNow\MovementTypeEnum;
use LogicNow\PieceColorEnum;
use LogicNow\Pieces\MovementValidator\KnightMovementValidator;


class Knight extends Piece
{

    const MAX_COUNT = 7;

    protected $_hasMoved = false;

    public function __construct(PieceColorEnum $pieceColorEnum)
    {
      parent::__construct($pieceColorEnum, new KnightMovementValidator());
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
