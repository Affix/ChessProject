<?php
namespace LogicNow\Pieces\MovementValidator;

use LogicNow\Piece;
use LogicNow\MovementTypeEnum;

interface MovementValidator
{
    public function validate(Piece $piece, $x, $y,  MovementTypeEnum $movementType);
}
