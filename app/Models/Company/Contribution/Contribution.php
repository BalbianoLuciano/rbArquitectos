<?php

namespace App\Models\Company\Contribution;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contribution extends Model
{
    use HasFactory;
    
    protected $table = 'contributions';

    public $timestamps = true;

    protected $fillable = [
        'company_id',
        'project_id',
        'description',
        'company_role',
        'project_update',
        'start',
        'end',
    ];
}
