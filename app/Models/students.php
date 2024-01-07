<?php

namespace App\Models;

use App\Models\rombels;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class students extends Model
{
    use HasFactory;
    protected $fillable = ([
        'nis',
        'name',
        'rombel_id',
        'rayon_id'
    ]);

    public function rombel(){
        return $this->belongsTo(rombels::class, 'rombel_id', 'id');
    }
    public function rayon(){
        return $this->belongsTo(rayons::class, 'rayon_id', 'id');
    }
    public function lates(){
        return $this->hasMany(lates::class, 'student_id', 'id');
    }

}
