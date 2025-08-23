<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /** @use HasFactory<\Database\Factories\ProjectFactory> */
    use HasFactory;

    protected $fillable= [
        'user_id',
        'title',
        'description',
        'status',
    ];

    public function users(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
