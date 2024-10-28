<?php

namespace App\Models;
use App\Constants\Status;
use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model {

    use Searchable;
    // protected $casts = [
    //     'detail' => 'object',
    // ];

    

}
