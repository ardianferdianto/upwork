<?php
/**
 * Created by PhpStorm.
 * User: ardianferdianto
 * Date: 07/02/19
 * Time: 16.49
 */

namespace App\Test\TestCase\Service;


use App\Model\Object\Date;
use App\Service\DateService;
use Cake\TestSuite\TestCase;

class DateServiceTest extends TestCase
{
    public function testDateDiff()
    {

        $dateObj1 = new Date("01/12/2012");
        $dateObj2 = new Date("01/03/2012");

        $dateService = new DateService;

        $diff = $dateService->date_diff($dateObj1, $dateObj2);

        $date1=date_create("2012-12-01");
        $date2=date_create("2012-03-01");
        $diffCompare=date_diff($date1,$date2);

        $this->assertEquals($diffCompare->days, $diff);
    }
}