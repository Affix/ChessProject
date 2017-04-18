<?php

namespace LogicNow;

class ChessBoard
{

    const MAX_BOARD_WIDTH = 7;
    const MAX_BOARD_HEIGHT = 7;

    const WHITE_START = 0;
    const BLACK_START = 7;

    private $_pieces;

    public function __construct()
    {
        $this->_pieces = array_fill(0, self::MAX_BOARD_WIDTH, array_fill(0, self::MAX_BOARD_HEIGHT, 0));
    }

    public function add(Pawn $pawn, $_xCoordinate, $_yCoordinate, PieceColorEnum $pieceColor)
    {
        //throw new \ErrorException("Need to implement ChessBoard.add() ");
        if($this->isLegalBoardPosition($_xCoordinate, $_yCoordinate))
        {
          $pawn->setXCoordinate($_xCoordinate);
          $pawn->setYCoordinate($_yCoordinate);
          $this->_pieces[$_xCoordinate][$_yCoordinate] = $pawn;
        }
        else {
          $_piece->setXCoordinate(-1);
          $_piece->setYCoordinate(-1);
        }

        return $this;
    }

    /** @return: boolean */
    public function isLegalBoardPosition($_xCoordinate, $_yCoordinate)
    {
        if($_yCoordinate > self::MAX_BOARD_HEIGHT ||
           $_xCoordinate > self::MAX_BOARD_WIDTH ||
           $_xCoordinate < 0 || $_yCoordinate < 0)
        {
          return False;
        }
        else
        {
          if(empty($this->_pieces[$_xCoordinate][$_yCoordinate]))
          {
            return True;
          }
          else
          {
            return False;
          }
        }
    }

    public function isDuplicatePosition()
    {

    }
}
