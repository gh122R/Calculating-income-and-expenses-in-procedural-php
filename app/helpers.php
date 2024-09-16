<?php

declare(strict_types=1);
function formatAmount(float $amount):string
{
    $Negative = $amount < 0;
    return ($Negative ? '-' : '' ) . number_format(abs($amount), 2). '₽';
}

function formatDate(string $date):string{
    return date ('M j, Y', strtotime($date));
}