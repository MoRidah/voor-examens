<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Item extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'price',
        'quantity',
        'active',
    ];
    
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'price' => 'decimal:2',
        'quantity' => 'integer',
        'active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    
    /**
     * Format the created_at attribute.
     *
     * @param  string  $value
     * @return string
     */
    public function getCreatedAtAttribute($value)
    {
        if (!$value) return null;
        
        if (is_string($value) && !strtotime($value)) {
            return $value;
        }
        
        return Carbon::parse($value)->format('F d, Y H:i:s');
    }
    
    /**
     * Format the updated_at attribute.
     *
     * @param  string  $value
     * @return string
     */
    public function getUpdatedAtAttribute($value)
    {
        if (!$value) return null;
        
        if (is_string($value) && !strtotime($value)) {
            return $value;
        }
        
        return Carbon::parse($value)->format('F d, Y H:i:s');
    }
}
