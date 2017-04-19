<?php

namespace LogicNow\Pieces\MovementValidator;

use LogicNow\Piece;
use LogicNow\Pieces\King;
use LogicNow\ChessBoard;

class KingMovementValidator implements MovementValidator
{
  public function validate(Piece $piece, $x, $y)
  {
    $old_x = $piece->getXCoordinate();
    $old_y = $piece->getYCoordinate();

    return abs($old_x - $x) <= $piece::MOVE_LIMIT &&
           abs($old_y - $y) <= $piece::MOVE_LIMIT;
  }
}
