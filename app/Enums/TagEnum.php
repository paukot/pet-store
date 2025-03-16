<?php

namespace App\Enums;

enum TagEnum: int
{
    case SMALL = 0;
    case MEDIUM = 1;
    case LARGE = 2;
    case FRIENDLY = 3;
    case PLAYFUL = 4;
    case CALM = 5;
    case HYPOALLERGENIC = 6;
    case SPECIAL_NEEDS = 7;
    case GOOD_WITH_KIDS = 8;
    case GOOD_WITH_OTHER_PETS = 9;
}
