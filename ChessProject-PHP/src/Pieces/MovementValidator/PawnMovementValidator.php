<?php
namespace LogicNow\Pieces\MovementValidator;

use LogicNow\Piece;
use LogicNow\Pieces\Pawn;
use LogicNow\ChessBoard;
use LogicNow\MovementTypeEnum;


class PawnMovementValidator implements MovementValidator
{
  protected $_piece;

  private $oldX;
  private $oldY;

  public function validate(Piece $piece, $x, $y, MovementTypeEnum $movementType)
  {
    $this->oldX = $piece->getXCoordinate();
    $this->oldY = $piece->getYCoordinate();
    $this->_piece = $piece;
    if($movementType == MovementTypeEnum::CAPTURE())
    {
      return $this->validateCapture($x, $y);
    }
    else {
      return $this->validateMove($x, $y);
    }
  }

  private function validateCapture($x, $y)
  {
    $chessBoard = $this->_piece->getChesssBoard();
    $capturedPiece = $chessBoard->getPieceAtCoordinate($x, $y);
    return version_compare($this->oldY, $y, $this->getMathematicsOperator()) &&
    abs($y - $this->oldY) <= $this->get_move_limit()
    && $capturedPiece->getPieceColor() != $this->_piece->getPieceColor();
  }

  private function validateMove($x, $y)
  {
    if($this->_piece->getCaptured())
    {
      return false;
    }
    return $this->oldX === $x &&
    version_compare($this->oldY, $y, $this->getMathematicsOperator()) &&
    abs($y - $this->oldY) <= $this->get_move_limit();
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
