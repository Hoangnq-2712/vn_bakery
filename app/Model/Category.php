<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class Category extends Model
{

	protected $table ='category';

	protected $fillable = [

		'name','slug','parent','status'
	];
	public function product()
	{
		return $this->hasMany('App\Model\Product', 'category_id', 'id');
	}

	public function scopeSearch($query){

		if(empty(request()->search)){
			return $query;
		}else{
			return $query->where('name','like','%'.request()->search.'%');
		}
	}
}
