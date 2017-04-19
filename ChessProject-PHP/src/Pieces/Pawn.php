<?php

namespace LogicNow\Pieces;


use LogicNow\Piece;
use LogicNow\MovementTypeEnum;
use LogicNow\PieceColorEnum;
use LogicNow\Pieces\MovementValidator\PawnMovementValidator;


class Pawn extends Piece
{

    const MAX_COUNT = 7;
    const MOVE_LIMIT = 1;
    const FIRST_MOVE_LIMIT = 2;

    protected $_hasMoved = false;

    public function __construct(PieceColorEnum $pieceColorEnum)
    {
      parent::__construct($pieceColorEnum, new PawnMovementValidator());
    }

    public function setHasMoved(bool $value)
    {
      $this->_hasMoved = $value;
    }

    public function getHasMoved()
    {
      return $this->_hasMoved;
    }

    public function move(MovementTypeEnum $movementTypeEnum, $newX, $newY)
    {
        if($this->_validator->validate($this, $newX, $newY, $movementTypeEnum))
        {
          if($movementTypeEnum == MovementTypeEnum::CAPTURE())
          {
            $board = $this->getChesssBoard();
            $board->getPieceAtCoordinate($newX, $newY)->setCaptured(true);
            $this->setYCoordinate($newY);
            $this->setXCoordinate($newX);
          }
          $this->setYCoordinate($newY);
          $this->setXCoordinate($newX);
        }
    }

}
