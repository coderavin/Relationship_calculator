<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;

    protected $fillable = [
        'calculation_id',
        'certificate_number',
        'issue_date',
        'valid_until',
        'template',
        'file_path'
    ];

    protected $casts = [
        'issue_date' => 'datetime',
        'valid_until' => 'datetime',
    ];

    public function calculation()
    {
        return $this->belongsTo(Calculation::class);
    }
}
