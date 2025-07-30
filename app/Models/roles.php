<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class roles extends Model
{
    
    protected $fillable = ['name'];
    public function permessions()
    {
        return $this->belongsToMany(permessions::class, 'role_permessions', 'role_id', 'permession_id');
    }
}
