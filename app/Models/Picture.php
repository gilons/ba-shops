<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Picture extends Model
{
    use HasFactory;
    protected $fillable = ['id','item_id','url'];
    protected $table = 'pictures';
    use SoftDeletes;
    public function item(){
        return $this->belongsTo(Item::class);
    }
}
