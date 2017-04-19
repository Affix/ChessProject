<?php
namespace LogicNow\Pieces\MovementValidator;

use LogicNow\Piece;

interface MovementValidator
{
    public function validate(Piece $piece, $x, $y);
}
