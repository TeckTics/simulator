<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TypeBase extends Model
{
    use HasFactory, SoftDeletes, HasFactory;

    protected $fillable = [
        'label',
        'image',
        'description',
        'published',
        'admin_id'
    ];

    protected $casts = [
        'published' => 'boolean',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class); 
    }

    public function base()
    {
        return $this->hasMany(Base::class); 
    }

}
