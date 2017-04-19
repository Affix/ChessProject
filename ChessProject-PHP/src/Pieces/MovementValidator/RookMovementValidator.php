<?php
namespace LogicNow\Pieces\MovementValidator;

use LogicNow\Piece;
use LogicNow\Pieces\Rook;
use LogicNow\ChessBoard;

class RookMovementValidator implements MovementValidator
{
  protected $_piece;

  public function validate(Piece $piece, $x, $y)
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
    $_chessBoard = $this->_piece->getChesssBoard();
    $_oldX = $this->_piece->getXCoordinate();
    $_oldY = $this->_piece->getYCoordinate();
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
