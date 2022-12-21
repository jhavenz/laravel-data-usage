<?php

namespace App\Models\Enums;

enum Operation: string
{
    case ADD = 'add';
    case SUBTRACT = 'subtract';
    case MULTIPLY = 'multiply';
    case DIVIDE = 'divide';
}
