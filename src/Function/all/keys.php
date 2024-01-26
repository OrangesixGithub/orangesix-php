<?php
if (!function_exists('GenereteKey')) {
    /**
     * Gera senha de forma randomica.
     * @param int $number
     * @return string
     */
    function GenereteKey(int $number = 8): string
    {
        $keys   = 'a-b-c-d-e-f-g-h-i-j-k-l-m-n-o-p-q-r-s-t-u-v-x-y-w-z';
        $keys  .= '-A-B-C-D-E-F-G-H-I-J-K-L-M-N-O-P-Q-R-S-T-U-V-X-Y-W-Z';
        $keys  .= '-0-1-2-3-4-5-6-7-9';
        $keys  .= '-!-@-#-$-%-&-*-_';
        $keys = explode('-', $keys);
        $keysNumber = count($keys) - 1;
        $newKey = "";
        for ($i = 0; $i < $number; $i++) {
            $newKey .= $keys[mt_rand(0, $keysNumber)];
        }
        return $newKey;
    }
}