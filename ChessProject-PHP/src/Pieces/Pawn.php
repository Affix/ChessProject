<?php

namespace LogicNow\Pieces;


use LogicNow\Piece;
use LogicNow\MovementTypeEnum;


class Pawn extends Piece
{

    const MAX_COUNT = 7;
    const MOVE_LIMIT = 1;

    private $_hasMoved = false;

    public function setHasMoved(bool $value)
    {
      $this->_hasMoved = $value;
    }

    public function move(MovementTypeEnum $movementTypeEnum, $newX, $newY)
    {
        $old_x = $this->getXCoordinate();
        $old_y = $this->getYCoordinate();
        $_move_limit = self::MOVE_LIMIT;

        if(!$this->_hasMoved)
        {
          $_move_limit = 2;
        }

        if($this->getPieceColor()->getValue()  == "BLACK" &&
          $old_x === $newX &&
          $old_y != $newY &&
          $old_y - $new_y <= $_move_limit)
        {
          $this->setYCoordinate($newY);
        }
        else {
          $this->setYCoordinate($old_y);
        }

        if($this->getPieceColor()->getValue()  == "WHITE" &&
          $old_x === $newX &&
          intval($old_y - $newY) <= $_move_limit)
        {
          $this->setYCoordinate($newY);
        }
        else {
          $this->setYCoordinate($old_y);
        }
    }
}
