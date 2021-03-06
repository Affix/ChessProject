<?php

namespace LogicNow\Test;

use LogicNow\ChessBoard;
use LogicNow\MovementTypeEnum;
use LogicNow\Pieces\Pawn;
use LogicNow\PieceColorEnum;
use PHPUnit_Framework_MockObject_MockObject;
use PHPUnit_Framework_TestCase;


class PawnTest extends \PHPUnit_Framework_TestCase
{

    /** @var  ChessBoard */
    private $_chessBoard;
    /** @var  Pawn */
    private $_testSubject;

    protected function setUp()
    {
        $this->_chessBoard = new ChessBoard();
        $this->_testSubject = new Pawn(PieceColorEnum::WHITE());

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

    public function testPawn_Move_IllegalCoordinates_Right_DoesNotMove()
    {
        $this->_chessBoard->add($this->_testSubject, 6, 3, PieceColorEnum::BLACK());
        $this->_testSubject->move(MovementTypeEnum::MOVE(), 7, 3);
        $this->assertEquals(6, $this->_testSubject->getXCoordinate());
        $this->assertEquals(3, $this->_testSubject->getYCoordinate());
    }

    public function testPawn_Move_IllegalCoordinates_Left_DoesNotMove()
    {
        $this->_chessBoard->add($this->_testSubject, 6, 3, PieceColorEnum::BLACK());
        $this->_testSubject->move(MovementTypeEnum::MOVE(), 4, 3);
        $this->assertEquals(6, $this->_testSubject->getXCoordinate());
        $this->assertEquals(3, $this->_testSubject->getYCoordinate());
    }

    public function testPawn_Move_LegalCoordinates_Forward_UpdatesCoordinates()
    {
        $this->_chessBoard->add($this->_testSubject, 6, 3, PieceColorEnum::BLACK());
        $this->_testSubject->move(MovementTypeEnum::MOVE(), 6, 2);
        $this->assertEquals(6, $this->_testSubject->getXCoordinate());
        $this->assertEquals(2, $this->_testSubject->getYCoordinate());
    }

    public function testPawn_Move_Two_Spaces_Initial_Move_UpdatesCoordinates()
    {
        $this->_chessBoard->add($this->_testSubject, 6, 6, PieceColorEnum::BLACK());
        $this->_testSubject->move(MovementTypeEnum::MOVE(), 6, 4);
        $this->assertEquals(6, $this->_testSubject->getXCoordinate());
        $this->assertEquals(4, $this->_testSubject->getYCoordinate());
    }

    public function testPawn_Cant_Move_Two_Spaces_After_Initial_Move()
    {
        $this->_testSubject->setHasMoved(true);
        $this->_chessBoard->add($this->_testSubject, 6, 6, PieceColorEnum::BLACK());
        $this->_testSubject->move(MovementTypeEnum::MOVE(), 6, 4);
        $this->assertEquals(6, $this->_testSubject->getXCoordinate());
        $this->assertNotEquals(4, $this->_testSubject->getYCoordinate());
    }

    public function testPawn_Can_Capture()
    {
      $this->_capturedPiece = new Pawn(PieceColorEnum::BLACK());
      $this->_chessBoard->add($this->_testSubject, 6, 6, PieceColorEnum::BLACK());
      $this->_chessBoard->add($this->_capturedPiece, 5, 5, PieceColorEnum::BLACK());
      $this->_testSubject->move(MovementTypeEnum::CAPTURE(), 5, 5);
      $this->assertEquals(5, $this->_testSubject->getXCoordinate());
      $this->assertEquals(5, $this->_testSubject->getYCoordinate());
      $this->assertEquals(true, $this->_capturedPiece->getCaptured());
    }

    public function testPawn_Cant_Capture_Own_Colour()
    {
      $this->_capturedPiece = new Pawn(PieceColorEnum::WHITE());
      $this->_chessBoard->add($this->_testSubject, 6, 6, PieceColorEnum::BLACK());
      $this->_chessBoard->add($this->_capturedPiece, 5, 5, PieceColorEnum::BLACK());
      $this->_testSubject->move(MovementTypeEnum::CAPTURE(), 5, 5);
      $this->assertEquals(6, $this->_testSubject->getXCoordinate());
      $this->assertEquals(6, $this->_testSubject->getYCoordinate());
      $this->assertNotEquals(true, $this->_capturedPiece->getCaptured());
    }

    public function testPawn_Cant_Move_If_Piece_Is_Captured()
    {
        $this->_testSubject->setHasMoved(true);
        $this->_testSubject->setCaptured(true);
        $this->_chessBoard->add($this->_testSubject, 6, 6, PieceColorEnum::BLACK());
        $this->_testSubject->move(MovementTypeEnum::MOVE(), 6, 5);
        $this->assertEquals(6, $this->_testSubject->getXCoordinate());
        $this->assertEquals(6, $this->_testSubject->getYCoordinate());
    }

}
