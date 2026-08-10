<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfessionTheme extends Model
{
    use HasFactory;

    protected $table = 'profession_themes';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'icon',
        'color',
        'view_template',
        'required_fields',
        'optional_fields',
        'sample_image',
        'status',
        'sort_order',
    ];

    protected $casts = [
        'required_fields' => 'array',
        'optional_fields' => 'array',
    ];

    /**
     * Get all customers using this theme
     */
    public function customers()
    {
        return $this->hasMany(customer::class, 'profession_type', 'id');
    }

    /**
     * Get all companies using this theme
     */
    public function companies()
    {
        return $this->hasMany(Company::class, 'profession_type', 'id');
    }

    /**
     * Scope to get only active themes
     */
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    /**
     * Scope to order by sort_order
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }

    /**
     * Get the full view path for this theme
     */
    public function getViewPathAttribute()
    {
        return 'frontend.profile-themes.' . ($this->view_template ?? 'default');
    }
}
