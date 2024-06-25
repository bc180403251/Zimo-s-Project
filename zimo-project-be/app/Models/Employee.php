<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Employee extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates=['deleted_at'];

    protected $fillable=[
        'first_name',
        'last_name',
        'phone',
        'gender',
        'email',
        'company_id'
    ];


    public $incrementing=false;
    public $keyType='uuid';


    protected static function boot()
    {

        parent::boot();

        static::creating(function ($modal){
            if(empty($modal->{$modal->getKeyName()})){
                $modal->{$modal->getKeyName()}= (string) str::uuid();

            }
        });

    }

    public static  function calculatePercentage($numberOfGender, $totalEmployees)
    {
        if($totalEmployees=== 0){
            return 0;
        }
        return ($numberOfGender / $totalEmployees)* 100;

    }


    public  function company ()
    {
        return $this->belongsTo(Company::class);

    }
}
