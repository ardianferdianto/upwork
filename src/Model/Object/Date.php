<?php
/**
 * Created by PhpStorm.
 * User: ardianferdianto
 * Date: 07/02/19
 * Time: 16.33
 */

namespace App\Model\Object;


class Date
{
    private $year;
    private $month;
    private $day;
    public $DAYSMONTH = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);

    public function __construct($date)
    {
        $date = explode("-", $date);
        $this->year = $date[0];
        $this->month = $date[1];
        $this->day = $date[2];
    }

    /**
     * @param mixed $day
     */
    public function setDay($day)
    {
        $this->day = $day;
    }

    /**
     * @param mixed $month
     */
    public function setMonth($month)
    {
        $this->month = $month;
    }

    /**
     * @param mixed $year
     */
    public function setYear($year)
    {
        $this->year = $year;
    }

    /**
     * @return mixed
     */
    public function getDay()
    {
        return $this->day;
    }

    /**
     * @return mixed
     */
    public function getMonth()
    {
        return $this->month;
    }

    /**
     * @return mixed
     */
    public function getYear()
    {
        return $this->year;
    }
}
