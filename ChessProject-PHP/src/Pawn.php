<?php

namespace LogicNow;


class Pawn
{

    /** @var PieceColorEnum */
    private $_pieceColorEnum;
    /** @var  ChessBoard */
    private $_chessBoard;
    /** @var  int */
    private $_xCoordinate;
    /** @var  int */
    private $_yCoordinate;

    const MAX_COUNT = 7;
    const MOVE_LIMIT = 1;

    private $_hasMoved = false;

    public function __construct(PieceColorEnum $pieceColorEnum)
    {
        $this->_pieceColorEnum = $pieceColorEnum;
    }

    public function getChesssBoard()
    {
        return $this->_chessBoard;
    }

    public function setChessBoard(ChessBoard $chessBoard)
    {
        $this->_chessBoard = $chessBoard;
    }

    /** @return int */
    public function getXCoordinate()
    {
        return $this->_xCoordinate;
    }

    /** @var int */
    public function setXCoordinate($value)
    {
        $this->_xCoordinate = $value;
    }

    /** @return int */
    public function getYCoordinate()
    {
        return $this->_yCoordinate;
    }

    /** @var int */
    public function setYCoordinate($value)
    {
        $this->_yCoordinate = $value;
    }

    public function getPieceColor()
    {
        return $this->_pieceColorEnum;
    }

    public function setPieceColor(PieceColorEnum $value)
    {
        $this->_pieceColorEnum = $value;
    }

    public function setHasMoved(bool $value)
    {
      $this->_hasMoved = $value;
    }

    public function move(MovementTypeEnum $movementTypeEnum, $newX, $newY)
    {
        $old_x = $this->getXCoordinate();
        $old_y = $this->getYCoordinate();
        $_move_limit = self::MOVE_LIMIT;

        if(!$this->_hasMoved)
        {
          $_move_limit = 2;
        }

        if($this->getPieceColor()->getValue()  == "BLACK" &&
          $old_x === $newX &&
          $old_y != $newY &&
          $old_y - $new_y <= $_move_limit)
        {
          $this->setYCoordinate($newY);
        }
        else {
          $this->setYCoordinate($old_y);
        }

        if($this->getPieceColor()->getValue()  == "WHITE" &&
          $old_x === $newX &&
          intval($old_y - $newY) <= $_move_limit)
        {
          $this->setYCoordinate($newY);
        }
        else {
          $this->setYCoordinate($old_y);
        }
    }

    public function toString()
    {
        return $this->currentPositionAsString();
    }

    protected function currentPositionAsString()
    {
        $result = "Current X: " . $this->_xCoordinate . PHP_EOL;
        $result .= "Current Y: " . $this->_yCoordinate . PHP_EOL;
        $result .= "Piece Color: " . $this->_pieceColorEnum;
        return $result;
    }

}
