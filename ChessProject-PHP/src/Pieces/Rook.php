<?php

namespace LogicNow\Pieces;


use LogicNow\Piece;
use LogicNow\MovementTypeEnum;
use LogicNow\PieceColorEnum;
use LogicNow\Pieces\MovementValidator\RookMovementValidator;



class Rook extends Piece
{

    const MAX_COUNT = 2;

    public function __construct(PieceColorEnum $pieceColorEnum)
    {
      parent::__construct($pieceColorEnum, new RookMovementValidator());
    }

    public function move(MovementTypeEnum $movementTypeEnum, $newX, $newY)
    {
      $old_x = $this->getXCoordinate();
      $old_y = $this->getYCoordinate();

      if(abs($old_x - $newX) <= self::MOVE_LIMIT &&
         abs($old_y - $newY) <= self::MOVE_LIMIT &&
         $this->isLegalPath($newX, $newY)
       )
      {
        $this->setYCoordinate($newY);
        $this->setXCoordinate($newX);
      }
    }

    private function isDiagonalMove($newX, $newY)
    {
      return $newX != $this->getXCoordinate() &&
             $newY != $this->getYCoordinate();
    }

    private function isLegalPath($newX, $newY)
    {
      $_chessBoard = $this->getChesssBoard();
      $_oldX = $this->getXCoordinate();
      $_oldY = $this->getYCoordinate();
      if(!$this->isDiagonalMove($newX, $newY))
      {
        if($newX != $_oldX)
        {
          for($i = ($_oldX + 1); $i <= $newX; $i++)
          {
            if(!$_chessBoard->isLegalBoardPosition($i, $newY))
            {
              return false;
            }
          }
          return true;
        }
        else {
          for($i = ($_oldY + 1); $i <= $newY; $i++)
          {
            if(!$_chessBoard->isLegalBoardPosition($newX, $i))
            {
              return false;
            }
          }
          return true;
        }
      }
    }

}
