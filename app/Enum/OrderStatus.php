<?php

namespace App\Enum;

enum OrderStatus:string
{
case NEW = 'new';

case IN_PROGRESS = 'in_progress';

case COMPLETED = 'completed';

}
