<?php

namespace Fintual;

use DateTime;
use Error;

class Portfolio
{
    private $Stocks;

    public function Profit(DateTime $starDate, DateTime $endDate)
    {
        if ($starDate <= $endDate) {
            $accumProfit = 0;
            foreach ($this->Stocks as $stok) {
                $initialPrice = $stok->Price($starDate);
                $finaltPrice = $stok->Price($endDate);
                $accumProfit += $this->getProfit($initialPrice, $finaltPrice);
            }
        } else {
            throw new Error("End date should be greather than Star Date", -1);
        }

        $dayDiff = $endDate->diff($starDate)->d;
        return $this->getAnnualizedReturn($accumProfit, $dayDiff);
    }

    public function getProfit($initialPrice, $finaltPrice)
    {
        return ($finaltPrice - $initialPrice) / $initialPrice;
    }

    public function getAnnualizedReturn($accumProfit, $dayDiff)
    {
        return pow(($accumProfit + 1), (1 / ($dayDiff / 365))) - 1;
    }
}

?>