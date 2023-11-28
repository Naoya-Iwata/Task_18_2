<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
	use HasFactory;
	protected $fillable = [
		'name',
		'path',
		'post_id',
	];

	// Postとの1対1のリレーションメソッドを定義
	public function posts()
	{
		return $this->belongsTo(Post::class);
	} /* @iwata */
}
