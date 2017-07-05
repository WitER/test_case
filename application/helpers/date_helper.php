<?php
function getStartAndEndDate($year, $week)
{
    return [
        (new DateTime())->setISODate($year, $week)->format('Y-m-d'), //start date
        (new DateTime())->setISODate($year, $week, 7)->format('Y-m-d') //end date
    ];
}