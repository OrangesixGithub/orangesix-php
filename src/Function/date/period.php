<?php
if (!function_exists('SumHours')) {
    /**
     * Recebe um array de horas em string e retorna a soma das diferenças entre os pares consecutivos de horas
     * convertidas para decimal, desde que o número de elementos no array seja par.
     * @param array $hours
     * @return float
     */
    function SumHours(array $hours): float
    {
        if (count($hours) % 2 !== 0) return 0;
        $count = null;
        $sumHours = 0;
        foreach ($hours as $key => $value)
            if ($key % 2 === 0)
                $count = hoursToDecimal($value);
            else
                $sumHours += (hoursToDecimal($value) - $count);
        return $sumHours;
    }
}

if (!function_exists('IsDateInRange')) {
    /**
     * Retorna se a data informada esta no range (inicio/fim)
     * @param string $date
     * @param string $startDate
     * @param string $endDate
     * @return bool
     * @throws Exception
     */
    function IsDateInRange(string $date, string $startDate, string $endDate): bool
    {
        $date = new DateTime($date);
        $start = new DateTime($startDate);
        $end = new DateTime($endDate);
        return ($date >= $start && $date <= $end);
    }
}

if (!function_exists('GetMonth')) {

    /**
     * Retorna o mês de acordo com paramentro
     * @param int $month
     * @return string
     */
    function GetMonth(int $month): string
    {
        return match ($month) {
            1 => 'Janeiro',
            2 => 'Fevereiro',
            3 => 'Março',
            4 => 'Abril',
            5 => 'Maio',
            6 => 'Junho',
            7 => 'Julho',
            8 => 'Agosto',
            9 => 'Setembro',
            10 => 'Outubro',
            11 => 'Novembro',
            12 => 'Dezembro',
            default => '',
        };
    }
}

if (!function_exists('GetFeriado')) {
    /**
     * Verifica se a data atual passada por parametro é feriado
     * @param string $data
     * @param array $feriadoFacutativo
     * @return bool
     */
    function GetFeriado (string $data = 'now', array $feriadoFacutativo = []): bool
    {
        try {
            $data = new DateTime($data);
            $dataOriginal = $data->getTimestamp();
            $ano = (int) $data->format('Y');
            $pascoa = easter_date($ano);

            //Define as datas dos feriados variáveis
            $carnaval = $data->setTimestamp(strtotime('-47 day', $pascoa))->format('d/m');
            $sextaSanta = $data->setTimestamp(strtotime('-2 day', $pascoa))->format('d/m');
            $corpusChristi = $data->setTimestamp(strtotime('+60 day', $pascoa))->format('d/m');

            //Lista de feriados nacionais com as datas fixas + variáveis
            $feriados = [
                '01/01', //Ano Novo
                $carnaval,
                $sextaSanta,
                '21/04', //Tiradentes
                '01/05', //Dia do Trabalho
                $corpusChristi,
                '07/09', //Independencia
                '12/10', //Nossa Senhora
                '02/11', //Finados
                '15/11', //Proclamacao da Republia
                '25/12', //Natal
            ];

            //Recupera a data original do parametro
            $compara = $data->setTimestamp($dataOriginal)->format('d/m');

            return in_array($compara, array_merge($feriados, $feriadoFacutativo));
        } catch (Exception $exception) {
            return false;
        }
    }
}

if (!function_exists('DiasUteis'))
{
    /**
     *  Recebe como parametro um objeto data inicial e um objeto data final e faz a contagem dos dias
     *  sem considerar os dias sábado, domingo e feriados nacionais, retorna o total da contagem
     * @param string $inicio
     * @param string $fim
     * @return int
     */
    function DiasUteis (string $inicio, string $fim): int
    {
        try {
            $inicio = new DateTime($inicio);
            $fim = new DateTime($fim);
            $dias = 0;

            while ($inicio <= $fim)
            {
                if ($inicio->format('w') != 6 && $inicio->format('w') != 0 && !GetFeriado($inicio->format('Y-m-d')))
                {
                    $dias += 1;
                }
                $inicio = $inicio->add(date_interval_create_from_date_string('1 day'));
            }
            return $dias;
        } catch (Exception $exception){
            return 0;
        }
    }
}
