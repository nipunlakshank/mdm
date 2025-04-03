<?php

namespace App\Enums;

enum FormActions: string
{
    case CREATE = 'create';
    case UPDATE = 'update';
    case DELETE = 'delete';
}
