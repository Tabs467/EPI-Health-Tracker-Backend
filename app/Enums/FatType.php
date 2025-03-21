<?php

namespace App\Enums;

enum FatType: string
{
    case None = '1';
    case Low = '2';
    case Medium = '3';
    case High = '4';
    case ExtraHigh = '5';
}
