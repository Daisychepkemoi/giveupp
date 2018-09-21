<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
     protected $fillable=[
     		'title','organization','address','phone','email','submitted_by','background','activities','summary','budget'
     	];

     public function proposal(){
     	 return $this->belongsTo(User::class);
     } 
     

}
