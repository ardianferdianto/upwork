<?php
/**
 * Created by PhpStorm.
 * User: ardianferdianto
 * Date: 07/02/19
 * Time: 16.48
 */

namespace App\Service;


use App\Model\Object\Date;

class DateService
{
    /**
     * Accepts two App\Model\Object\Date Object.
     */
    public function date_diff(Date $one, Date $two)
    {

        $year1 = $one->getYear() * 365 + $one->getDay();

        for ($i = 0; $i < $one->getMonth() - 1; $i++) {
            $year1 += $one->DAYSMONTH[$i];
        }

        $year1 += $this->countLeapYears($one);

        $year2 = $two->getYear() * 365 + $two->getDay();

        for ($i = 0; $i < $two->getMonth() - 1; $i++) {
            $year2 += $two->DAYSMONTH[$i];
        }

        $year2 += $this->countLeapYears($two);


        return abs($year2 - $year1);
    }

    public function countLeapYears(Date $date)
    {
        $years = $date->getYear();

        // Check if the current year needs to be considered
        // for the count of leap years or not
        if ($date->getMonth() <= 2)
        {
            $years--;
        }

        // An year is a leap year if it is a multiple of 4,
        // multiple of 400 and not a multiple of 100.
        return intval($years / 4) - intval($years / 100) + intval($years / 400);
    }
}