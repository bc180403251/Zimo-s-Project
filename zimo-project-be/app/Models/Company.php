<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Company extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates= ['deleted_at'];

    protected $fillable = [
        'name',
        'email',
        'logo'

    ];




    public function employees()
    {


        return $this->hasMany(Employee::class);

    }

    public static function lookup()
    {

        return self::select('id','name')->get();

    }
}
