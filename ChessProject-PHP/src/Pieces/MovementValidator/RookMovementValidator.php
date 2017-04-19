<?php
namespace LogicNow\Pieces\MovementValidator;

use LogicNow\Piece;
use LogicNow\Pieces\Rook;
use LogicNow\ChessBoard;
use LogicNow\MovementTypeEnum;


class RookMovementValidator implements MovementValidator
{
  protected $_piece;

  public function validate(Piece $piece, $x, $y, MovementTypeEnum $movementType)
  {
    $old_x = $piece->getXCoordinate();
    $old_y = $piece->getYCoordinate();
    $this->_piece = $piece;
    return abs($old_x - $x) <= $this->_piece::MOVE_LIMIT &&
       abs($old_y - $y) <= $this->_piece::MOVE_LIMIT &&
       $this->isLegalPath($x, $y);
  }

  private function isDiagonalMove($newX, $newY)
  {
    return $newX != $this->_piece->getXCoordinate() &&
           $newY != $this->_piece->getYCoordinate();
  }

  private function isLegalPath($newX, $newY)
  {
    $_oldX = $this->_piece->getXCoordinate();
    $_oldY = $this->_piece->getYCoordinate();
    if(!$this->isDiagonalMove($newX, $newY))
    {
      if($newX != $_oldX)
      {
        return $this->isPathClear($newY, $_oldX, $newX);
      }
      else {
        return $this->isPathClear($newX, $_oldY, $newY);
      }
    }
  }

  private function isPathClear($static, $from, $to)
  {
    for($i = ($from + 1); $i <= $to; $i++)
    {
      if(!$this->_piece->getChesssBoard()->isLegalBoardPosition($static, $i))
      {
        return false;
      }
    }
    return true;
  }
}
