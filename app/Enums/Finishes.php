<?php

declare(strict_types=1);

namespace App\Enums;

enum Finishes: string
{
    case NONFOIL = 'nonfoil';

    case FOIL = 'foil';

    case ETCHED = 'etched';

}
