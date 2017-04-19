<?php
namespace LogicNow\Pieces\MovementValidator;

use LogicNow\Piece;
use LogicNow\Pieces\Pawn;
use LogicNow\ChessBoard;
use LogicNow\MovementTypeEnum;


class PawnMovementValidator implements MovementValidator
{
  protected $_piece;

  public function validate(Piece $piece, $x, $y, MovementTypeEnum $movementType)
  {
    $old_x = $piece->getXCoordinate();
    $old_y = $piece->getYCoordinate();
    $this->_piece = $piece;
    if($movementType == MovementTypeEnum::CAPTURE())
    {
      return version_compare($old_y, $y, $this->getMathematicsOperator()) &&
      abs($y - $old_y) <= $this->get_move_limit();
    }
    else {
      return $this->validate_move($x, $y);
    }
  }

  private function validate_move($x, $y)
  {
    $old_x = $this->_piece->getXCoordinate();
    $old_y = $this->_piece->getYCoordinate();
    if($this->_piece->getCaptured())
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
