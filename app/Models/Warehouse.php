<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;
    protected $table = 'warehouse';

    protected $fillable = [
        'branch_id',
        'supplier_id',
        'import_date',
        'total_amount',
        'type',
        'note',
    ];
}
