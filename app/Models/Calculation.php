<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calculation extends Model
{
    use HasFactory;

    protected $fillable = [
        'member1_name',
        'member1_gender',
        'member2_name',
        'member2_gender',
        'calculation_type',
        'percentage',
        'description',
        'compatibility_points',
        'improvement_tips',
        'unique_id'
    ];

    protected $casts = [
        'compatibility_points' => 'array',
        'improvement_tips' => 'array',
    ];

    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }

    public function getTypeLabelAttribute()
    {
        $types = [
            'love' => 'Love Compatibility',
            'friendship' => 'Friendship Bond',
            'relationship' => 'Relationship Score',
            'antagonist' => 'Antagonist Level'
        ];
        return $types[$this->calculation_type] ?? ucfirst($this->calculation_type);
    }

    public function getIconAttribute()
    {
        $icons = [
            'love' => '❤️',
            'friendship' => '🤝',
            'relationship' => '💑',
            'antagonist' => '⚡'
        ];
        return $icons[$this->calculation_type] ?? '📊';
    }

    public function getLevelAttribute()
    {
        if ($this->percentage < 45) return 'Low';
        elseif ($this->percentage < 65) return 'Medium';
        elseif ($this->percentage < 85) return 'High';
        else return 'Perfect';
    }

    public function getLevelColorAttribute()
    {
        if ($this->percentage < 45) return 'red';
        elseif ($this->percentage < 65) return 'yellow';
        elseif ($this->percentage < 85) return 'green';
        else return 'purple';
    }
}
