<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = ['plan_name', 'price', 'features'];

    protected $casts = [
        'features' => 'array',
    ];
}
