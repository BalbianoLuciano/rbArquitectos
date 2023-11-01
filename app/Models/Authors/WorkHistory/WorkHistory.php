<?php

namespace App\Models\Authors\WorkHistory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class WorkHistory extends Pivot
{
    use HasFactory;

    protected $table = 'work_histories';

    protected $primaryKey = 'work_history_id';

    public $timestamps = true;

    protected $fillable = [
        'author_id',
        'company_id',
        'position',
        'start',
        'end',
    ];
}
