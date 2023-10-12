<?php

namespace App\Models\Company\Contribution;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Contribution extends Pivot
{
    protected $table = 'contributions';

    public $timestamps = true;
    
    protected $fillable = [
        'description',
        'company_role',
        'project_update',
        'start',
        'end',
    ];
    
    protected $dates = [
        'start',
        'end',
    ];
}
