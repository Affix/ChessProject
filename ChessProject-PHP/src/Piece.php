<?php
namespace LogicNow;

use LogicNow\PieceColorEnum;
use LogicNow\MovementTypeEnum;
use LogicNow\ChessBoard;

abstract class Piece
{
  /** @var PieceColorEnum */
  private $_pieceColorEnum;
  /** @var  ChessBoard */
  protected $_chessBoard;
  /** @var  int */
  private $_xCoordinate;
  /** @var  int */
  private $_yCoordinate;

  protected $_validator;

  protected $_captured = false;

  const MAX_COUNT = 1;
  const MOVE_LIMIT = 7;

  public function __construct(PieceColorEnum $pieceColorEnum, $validator)
  {
      $this->_pieceColorEnum = $pieceColorEnum;
      $this->setValidator($validator);
  }

  public function getChesssBoard()
  {
      return $this->_chessBoard;
  }

  public function setChessBoard(ChessBoard $chessBoard)
  {
      $this->_chessBoard = $chessBoard;
  }

  public function setCaptured(bool $captured)
  {
    $this->_captured = $captured;
    if($captured)
    {
      $this->setXCoordinate(-1);
      $this->setYCoordinate(-1);_
    }
  }

  public function getCaptured()
  {
    return $this->_captured;
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

  public function setValidator($validator)
  {
    $this->_validator = $validator;
  }

  public function getValidator()
  {
    return $this->_validator;
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
