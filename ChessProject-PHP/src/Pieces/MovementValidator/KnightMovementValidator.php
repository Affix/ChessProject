<?php

namespace LogicNow\Pieces\MovementValidator;

use LogicNow\Piece;
use LogicNow\Pieces\Knight;
use LogicNow\ChessBoard;
use LogicNow\MovementTypeEnum;


class KnightMovementValidator implements MovementValidator
{
  public function validate(Piece $piece, $x, $y, MovementTypeEnum $movementType)
  {
    $oldX = $piece->getXCoordinate();
    $oldY = $piece->getYCoordinate();

    $xd = abs($oldX - $x);
    $xy = abs($oldY - $y);
    return ($xd == 2 && $xy == 1) || ($xd == 1 && $xy == 2);
  }
}
