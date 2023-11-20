<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Chatify\Traits\UUID;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChMessage extends Model
{
    use UUID, SoftDeletes;
}
