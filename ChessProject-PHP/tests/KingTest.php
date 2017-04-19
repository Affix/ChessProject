<?php

namespace LogicNow\Test;

use LogicNow\ChessBoard;
use LogicNow\MovementTypeEnum;
use LogicNow\Pieces\King;
use LogicNow\PieceColorEnum;
use PHPUnit_Framework_MockObject_MockObject;
use PHPUnit_Framework_TestCase;


class KingTest extends \PHPUnit_Framework_TestCase
{

    /** @var  ChessBoard */
    private $_chessBoard;
    /** @var  King */
    private $_testSubject;

    protected function setUp()
    {
        $this->_chessBoard = new ChessBoard();
        $this->_testSubject = new King(PieceColorEnum::WHITE());

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

    public function testKing_Move_IllegalCoordinates_Right_DoesMove()
    {
        $this->_chessBoard->add($this->_testSubject, 6, 3, PieceColorEnum::BLACK());
        $this->_testSubject->move(MovementTypeEnum::MOVE(), 7, 3);
        $this->assertEquals(7, $this->_testSubject->getXCoordinate());
        $this->assertEquals(3, $this->_testSubject->getYCoordinate());
    }

    public function testKing_Move_IllegalCoordinates_Left_DoesMove()
    {
        $this->_chessBoard->add($this->_testSubject, 6, 3, PieceColorEnum::BLACK());
        $this->_testSubject->move(MovementTypeEnum::MOVE(), 5, 3);
        $this->assertEquals(5, $this->_testSubject->getXCoordinate());
        $this->assertEquals(3, $this->_testSubject->getYCoordinate());
    }

    public function testKing_Move_LegalCoordinates_Forward_UpdatesCoordinates()
    {
        $this->_chessBoard->add($this->_testSubject, 6, 3, PieceColorEnum::BLACK());
        $this->_testSubject->move(MovementTypeEnum::MOVE(), 6, 2);
        $this->assertEquals(6, $this->_testSubject->getXCoordinate());
        $this->assertEquals(2, $this->_testSubject->getYCoordinate());
    }


}
