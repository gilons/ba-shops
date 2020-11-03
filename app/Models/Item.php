<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use HasFactory;
    protected $fillable = ['id','name', 'description', 'user_id', 'cost'];
    protected $table = 'items';
    use SoftDeletes;
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function picture(){
        return $this->hasMany(Picture::class);
    }
}
