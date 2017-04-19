<?php

namespace LogicNow\Pieces;


use LogicNow\Piece;
use LogicNow\MovementTypeEnum;


class Pawn extends Piece
{

    const MAX_COUNT = 7;
    const MOVE_LIMIT = 1;
    const FIRST_MOVE_LIMIT = 2;

    private $_hasMoved = false;

    public function setHasMoved(bool $value)
    {
      $this->_hasMoved = $value;
    }

    public function move(MovementTypeEnum $movementTypeEnum, $newX, $newY)
    {
        $old_x = $this->getXCoordinate();
        $old_y = $this->getYCoordinate();


        if(
          $old_x === $newX &&
          version_compare($old_y, $newY, $this->getMathematicsOperator()) &&
          abs($newY - $old_y) <= $this->get_move_limit())
        {
          $this->setYCoordinate($newY);
        }
    }

    private function get_move_limit()
    {
      if(!$this->_hasMoved)
      {
        return self::FIRST_MOVE_LIMIT;
      }
      else {
        return self::MOVE_LIMIT;
      }
    }

    private function getMathematicsOperator()
    {
      $_colour = $this->getPieceColor();

      if($_colour == "BLACK")
      {
        return "<";
      }
      else {
        return ">";
      }
    }
}
