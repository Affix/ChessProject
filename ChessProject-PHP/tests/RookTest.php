<?php

namespace LogicNow\Test;

use LogicNow\ChessBoard;
use LogicNow\MovementTypeEnum;
use LogicNow\Pieces\Rook;
use LogicNow\Pieces\Pawn;
use LogicNow\PieceColorEnum;
use PHPUnit_Framework_MockObject_MockObject;
use PHPUnit_Framework_TestCase;


class RookTest extends \PHPUnit_Framework_TestCase
{

    /** @var  ChessBoard */
    private $_chessBoard;
    /** @var  Rook */
    private $_testSubject;

    protected function setUp()
    {
        $this->_chessBoard = new ChessBoard();
        $this->_testSubject = new Rook(PieceColorEnum::WHITE());

    }

    public function testChessBoard_Add_Sets_XCoordinate()
    {
        $this->_chessBoard->add($this->_testSubject, 6, 3, PieceColorEnum::BLACK());
        $this->assertEquals(6, $this->_testSubject->getXCoordinate());
    }

    public function testChessBoard_Add_Sets_YCoordinate()
    {
        $this->_chessBoard->add($this->_testSubject, 6, 3, PieceColorEnum::BLACK());
        $this->assertEquals(3, $this->_testSubject->getYCoordinate());
    }

    public function testRook_Move_llegalCoordinates_Right_DoesMove()
    {
        $this->_chessBoard->add($this->_testSubject, 6, 3, PieceColorEnum::BLACK());
        $this->_testSubject->move(MovementTypeEnum::MOVE(), 7, 3);
        $this->assertEquals(7, $this->_testSubject->getXCoordinate());
        $this->assertEquals(3, $this->_testSubject->getYCoordinate());
    }

    public function testRook_Move_IllegalCoordinates_Diagonal_DoesNotMove()
    {
        $this->_chessBoard->add($this->_testSubject, 6, 3, PieceColorEnum::BLACK());
        $this->_testSubject->move(MovementTypeEnum::MOVE(), 7, 4);
        $this->assertEquals(6, $this->_testSubject->getXCoordinate());
        $this->assertEquals(3, $this->_testSubject->getYCoordinate());
    }

    public function testRook_Move_llegalCoordinates_Left_DoesMove()
    {
        $this->_chessBoard->add($this->_testSubject, 6, 3, PieceColorEnum::BLACK());
        $this->_testSubject->move(MovementTypeEnum::MOVE(), 5, 3);
        $this->assertEquals(5, $this->_testSubject->getXCoordinate());
        $this->assertEquals(3, $this->_testSubject->getYCoordinate());
    }

    public function testRook_Move_LegalCoordinates_Forward_UpdatesCoordinates()
    {
        $this->_chessBoard->add($this->_testSubject, 6, 3, PieceColorEnum::BLACK());
        $this->_testSubject->move(MovementTypeEnum::MOVE(), 6, 2);
        $this->assertEquals(6, $this->_testSubject->getXCoordinate());
        $this->assertEquals(2, $this->_testSubject->getYCoordinate());
    }

    public function testRook_Move_IllegalCoordinates_Blocked_Path_DoesNotMove()
    {
      $this->_blockingPawn = new Pawn(PieceColorEnum::WHITE());
      $this->_chessBoard->add($this->_testSubject, 6, 3, PieceColorEnum::BLACK());
      $this->_chessBoard->add($this->_testSubject, 6, 4, PieceColorEnum::BLACK());
      $this->_testSubject->move(MovementTypeEnum::MOVE(), 6, 5);
      $this->assertEquals(6, $this->_testSubject->getXCoordinate());
      $this->assertEquals(3, $this->_testSubject->getYCoordinate());
    }

}
