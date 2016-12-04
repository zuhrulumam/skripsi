<?php

use Litipk\BigNumbers\Decimal as Decimal;


date_default_timezone_set('UTC');


class DecimalAdditiveInverseTest extends PHPUnit_Framework_TestCase
{
    public function testZeroAdditiveInverse()
    {
        $this->assertTrue(Decimal::fromInteger(0)->additiveInverse()->equals(Decimal::fromInteger(0)));
    }

    public function testNegativeAdditiveInverse()
    {
        $this->assertTrue(Decimal::fromInteger(-1)->additiveInverse()->equals(Decimal::fromInteger(1)));
        $this->assertTrue(Decimal::fromString('-1.768')->additiveInverse()->equals(Decimal::fromString('1.768')));
    }

    public function testPositiveAdditiveInverse()
    {
        $this->assertTrue(Decimal::fromInteger(1)->additiveInverse()->equals(Decimal::fromInteger(-1)));
        $this->assertTrue(Decimal::fromString('1.768')->additiveInverse()->equals(Decimal::fromString('-1.768')));
    }
}
