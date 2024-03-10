<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property numeric        $id
 * @property string         $name
 * @property Carbon         $created_at
 * @property Carbon         $updated_at
 *
 */
class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
    ];

    protected $casts = [
        'created_at'    => 'datetime:Y-m-d H:i:s',
        'updated_at'    => 'datetime:Y-m-d H:i:s',
    ];
}
