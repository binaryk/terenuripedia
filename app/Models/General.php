<?php

namespace App\Models;

class General
{
    public static function per()
    {
        return [
            '0' => '- Selectati -',
            '1' => 'An',
            '2' => 'Luna',
            /*'3' => 'Semestru',*/
        ];
    }

    public static function percent()
    {
        return [
            '0' => '- Selectati -',
            '5' => '2 - 5 terenuri',
            '10' => '6 - 10 terenuri',
            '15' => '11 - 15 terenuri',
            '20' => '16 - 16+ terenuri',
        ];
    }

}

