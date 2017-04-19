<?php

namespace LogicNow;

use LogicNow\Piece;
use LogicNow\Pieces\Pawn;
use LogicNow\Pieces\King;

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

    public function add(Piece $piece, $_xCoordinate, $_yCoordinate, PieceColorEnum $pieceColor)
    {
        //throw new \ErrorException("Need to implement ChessBoard.add() ");
        $counts = $this->countPawns($this->_pieces);
        $color = $piece->getPieceColor()->getValue();
        if($this->isLegalBoardPosition($_xCoordinate, $_yCoordinate) &&
          $counts[$color] < $piece::MAX_COUNT)
        {
          $piece->setXCoordinate($_xCoordinate);
          $piece->setYCoordinate($_yCoordinate);
          $this->_pieces[$_xCoordinate][$_yCoordinate] = $piece;
          $piece->setChessBoard($this);
        }
        else {
          $piece->setXCoordinate(-1);
          $piece->setYCoordinate(-1);
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

    public function countPawns(array $_board)
    {
      $_counts = [
        'BLACK' => 0,
        'WHITE' => 0
      ];

      foreach($_board as $_row)
      {
        foreach($_row as $_tile)
        {
          if($_tile instanceof Pawn)
          {
            $_color = $_tile->getPieceColor()->getValue();
            if (!isset($_counts[$_color])) {
              $_counts[$_color] = 0;
            }
            $_counts[$_color]++;
          }
        }
      }
      return $_counts;
    }
}
