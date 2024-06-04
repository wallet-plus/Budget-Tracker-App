<?php
// CurrencyFormatHelper.php
namespace app\helpers;

class CurrencyFormatHelper
{
    public static function formatCurrency($amount, $currency = 'Rs.')
    {
        // Format the amount
        $formattedAmount = number_format((float)$amount, 2, '.', '');
        return $currency . ' ' . preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $formattedAmount);
    }
}
