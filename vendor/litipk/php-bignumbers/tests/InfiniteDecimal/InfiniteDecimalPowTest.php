<?php

use Litipk\BigNumbers\Decimal as Decimal;
use Litipk\BigNumbers\InfiniteDecimal as InfiniteDecimal;
use Litipk\BigNumbers\DecimalConstants as DecimalConstants;


date_default_timezone_set('UTC');


class InfiniteDecimalPowTest extends PHPUnit_Framework_TestCase
{
    public function testPositiveInfinitePositivePower()
    {
        $pInf = InfiniteDecimal::getPositiveInfinite();

        $this->assertTrue($pInf->pow(Decimal::fromInteger(1))->equals($pInf));
        $this->assertTrue($pInf->pow(Decimal::fromInteger(2))->equals($pInf));
        $this->assertTrue($pInf->pow(Decimal::fromInteger(3))->equals($pInf));

        $this->assertTrue($pInf->pow($pInf)->equals($pInf));
    }

    public function testPositiveInfiniteNegativePower()
    {
        $pInf = InfiniteDecimal::getPositiveInfinite();
        $nInf = InfiniteDecimal::getNegativeInfinite();
        $zero = DecimalConstants::Zero();

        $this->assertTrue($pInf->pow(Decimal::fromInteger(-1))->equals($zero));
        $this->assertTrue($pInf->pow(Decimal::fromInteger(-2))->equals($zero));
        $this->assertTrue($pInf->pow(Decimal::fromInteger(-3))->equals($zero));

        $this->assertTrue($pInf->pow($nInf)->equals($zero));
    }

    public function testNegativeInfinitePositiveFinitePower()
    {
        $pInf = InfiniteDecimal::getPositiveInfinite();
        $nInf = InfiniteDecimal::getNegativeInfinite();

        $this->assertTrue($nInf->pow(Decimal::fromInteger(1))->equals($nInf));
        $this->assertTrue($nInf->pow(Decimal::fromInteger(2))->equals($pInf));
        $this->assertTrue($nInf->pow(Decimal::fromInteger(3))->equals($nInf));
        $this->assertTrue($nInf->pow(Decimal::fromInteger(4))->equals($pInf));
    }

    /**
     * @expectedException \DomainException
     * @expectedExceptionMessage Negative infinite elevated to infinite is undefined.
     */
    public function testNegativeInfinitePositiveInfinitePower()
    {
        InfiniteDecimal::getNegativeInfinite()->pow(InfiniteDecimal::getPositiveInfinite());
    }

    public function testNegativeInfiniteNegativePower()
    {
        $nInf = InfiniteDecimal::getNegativeInfinite();
        $zero = DecimalConstants::Zero();

        $this->assertTrue($nInf->pow(Decimal::fromInteger(-1))->equals($zero));
        $this->assertTrue($nInf->pow(Decimal::fromInteger(-2))->equals($zero));
        $this->assertTrue($nInf->pow(Decimal::fromInteger(-3))->equals($zero));

        $this->assertTrue($nInf->pow($nInf)->equals($zero));
    }

    /**
     * @expectedException \DomainException
     * @expectedExceptionMessage Infinite elevated to zero is undefined.
     */
    public function testPositiveInfiniteZeroPower()
    {
        InfiniteDecimal::getPositiveInfinite()->pow(DecimalConstants::Zero());
    }

    /**
     * @expectedException \DomainException
     * @expectedExceptionMessage Infinite elevated to zero is undefined.
     */
    public function testNegativeInfiniteZeroPower()
    {
        InfiniteDecimal::getNegativeInfinite()->pow(DecimalConstants::Zero());
    }
}
