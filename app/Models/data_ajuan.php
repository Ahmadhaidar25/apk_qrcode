<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class data_ajuan extends Model
{
    use HasFactory;

    protected $table ="data_ajuan";
    protected $fillable = ['id','user_id','no_tlp','ajuan'];


    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
