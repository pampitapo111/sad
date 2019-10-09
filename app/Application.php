<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;


class Application extends Model 
{
    use Notifiable;
    protected $table = 'application';
 
    public function jobs(){
        return $this->hasMany(Job::class,'id','job_id');
    }



  

}
