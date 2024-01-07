<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lates extends Model
{
    use HasFactory;
    protected $fillable = ([
        'student_id',
        'date_time_late',
        'information',
        'bukti',
    ]);

    public function students() {
        return $this->belongsTo(students::class, 'student_id', 'id');

    }
}
