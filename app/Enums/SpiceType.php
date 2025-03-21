<?php

namespace App\Enums;

enum SpiceType: string
{
    case None = '1';
    case Mild = '2';
    case Medium = '3';
    case Spicy = '4';
    case ExtraSpicy = '5';
}