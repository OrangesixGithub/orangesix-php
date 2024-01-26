<?php
if (!function_exists("DecimalToHours")){
    /**
     * Converte decimal para horas
     * @param float $decimal
     * @return string
     */
    function DecimalToHours(float $decimal): string
    {
        $decimal = round($decimal, 2);
        $division = explode('.', $decimal);
        $hours = $division[0];
        if (isset($division[1])) {
            $min = str_pad($division[1], 2, '0', STR_PAD_RIGHT);
            $min = round(($min * 60) / 100, 0, PHP_ROUND_HALF_UP);
        } else
            $min = 0;
        $hours = str_pad($hours, 2, '0', STR_PAD_LEFT);
        $min = str_pad($min, 2, '0', STR_PAD_LEFT);
        return $hours . ':' . $min;
    }
}

if (!function_exists('HoursToDecimal')) {
    /**
     * Converte horas para decimal
     * @param string $hours
     * @param int $decimais
     * @return float
     */
    function HoursToDecimal(string $hours, int $decimais = 2): float
    {
        if (!strstr($hours, ':'))
            return 0;
        $arrHours = explode(':', $hours);
        $valueHours = (int)$arrHours[0];
        $valueMinute = (int)$arrHours[1];
        $minuteDecimal = $valueMinute / 60;
        return (float) number_format($valueHours + $minuteDecimal, $decimais, '.', '');
    }
}

if (!function_exists('HoursToMinute')) {
    /**
     * Converte horas para minuto
     * @param string $value
     * @return int
     */
    function HoursToMinute(string $value): int
    {
        if (strstr($value, ":")) {
            $arrayValue = explode(":", $value);
            $valorMin = (int)$arrayValue[1];
            $valorHours = (int)$arrayValue[0];
            return (int)(($valorHours * 60) + $valorMin);
        } else
            return 0;
    }
}

if (!function_exists('MinuteToHours')) {
    /**
     * Converte minutos para horas
     * @param int|float $valor
     * @return string
     */
    function MinuteToHours(int|float $valor): string
    {
        $division = number_format($valor / 60, 2, ',', ''); // valor decimal
        $arrayValue = explode(",", $division);
        $valueHours = $arrayValue[0];
        $valueMin = round(($arrayValue[1] * 60) / 100);
        if (strlen($valueHours) == 1)
            $valueHours = "0" . $valueHours;
        if (strlen($valueMin) < 2)
            $valueMin = "0" . $valueMin;
        return $valueHours . ":" . $valueMin;
    }
}

if (!function_exists('SecondsToHours')) {
    /**
     * Converte segundos para horas
     * @param int $seconds
     * @return string
     */
    function SecondsToHours(int $seconds): string
    {
        $minutes = $seconds / 60;
        return floatval(number_format($minutes / 60, 2, '.', ''));
    }
}