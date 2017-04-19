<?php
namespace LogicNow\Pieces\MovementValidator;

use LogicNow\Pieces\Piece;

abstract class MovementValidator
{
    public function validate(Piece $piece, $newX, $newY);
}
