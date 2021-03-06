<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
class Post extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;
		
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'posts';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	
    protected $fillable = array('title' , 'description');
	protected $rules = ['title'=>'required' ,
	'description'=>'required'];
	
	
		public function delcomment(){
				return $this->hasMany(Comment::class,'post_id','id');
			}
		public function comment(){
			return $this->hasMany(Comment::class);
			}
		public function comments(){
			return $this->hasMany(Comment::class,'id')->whereNull('parent_id');
			}
	 	public function users(){
				return $this->belongsTo('User','user_id','id');
			}
		public function usersmarked(){
				return $this->belongsTo('User','marked_by','id');
			}
		public function favourites(){
				return $this->belongsTo(User::class,'marked_by','id');
			}
}


