<?php
namespace LogicNow\Pieces\MovementValidator;

use LogicNow\Piece;
use LogicNow\Pieces\Pawn;
use LogicNow\ChessBoard;

class PawnMovementValidator implements MovementValidator
{
  protected $_piece;

  public function validate(Piece $piece, $x, $y)
  {
    $old_x = $piece->getXCoordinate();
    $old_y = $piece->getYCoordinate();
    $this->_piece = $piece;
    if($piece->getCaptured())
    {
      return false;
    }
    return $old_x === $x &&
    version_compare($old_y, $y, $this->getMathematicsOperator()) &&
    abs($y - $old_y) <= $this->get_move_limit();
  }

  private function get_move_limit()
  {
    if(!$this->_piece->getHasMoved())
    {
      return $this->_piece::FIRST_MOVE_LIMIT;
    }
    else {
      return $this->_piece::MOVE_LIMIT;
    }
  }

  private function getMathematicsOperator()
  {
    $_colour = $this->_piece->getPieceColor();

    if($_colour == "BLACK")
    {
      return "<";
    }
    else {
      return ">";
    }
  }
}
