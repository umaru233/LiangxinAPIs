<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model {

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['type', 'title', 'excerpt', 'content', 'event_date', 'event_address', 'event_type', 'class_type', 'banner_position', 'due_date', 'url', 'likes'];
	
	public function parent()
	{
		return $this->belongsTo('App\Post');
	}
	
	public function children()
	{
		return $this->hasMany('App\Post', 'parent_id');
	}

	public function author()
	{
		return $this->belongsTo('App\User');
	}
	
	public function group()
	{
		return $this->belongsTo('App\Group');
	}
	
	public function getCommentsAttribute()
	{
		return $this->children()->where('type', '评论')->get();
	}
	
	public function getImagesAttribute()
	{
		return $this->children()->where('type', '图片')->get();
	}
	
	public function getArticlesAttribute()
	{
		return $this->children()->where('type', '文章')->get();
	}
	
	public function getVideosAttribute()
	{
		return $this->children()->where('type', '视频')->get();
	}
	
	public function getAttachmentsAttribute()
	{
		return $this->children()->where('type', '附件')->get();
	}
	
}
