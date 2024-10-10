<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserVaccineCenterPivot extends Model
{
   protected $table = 'user_vaccine_centers';
   public $timestamps = false;
   protected $fillable = ['user_id','center_id','registered_at'];

   protected $with = ['vaccine_center'];

   public function vaccine_center(){
      return $this->hasOne(VaccineCenter::class,'id','center_id');
   }
}
