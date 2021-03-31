<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Tag;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'name',
        'slug',
        'excerpt',
        'body',
        'status',
        'published_at',
        'foto'
    ];

    protected $dates = ['published_at'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function scopePublished($query)
    {
        $query->whereNotNull('published_at')
        ->orderBy('published_at', 'DESC')
        ->where('published_at', '<=', Carbon::now())
        ->where('status','PUBLISHED');
    }
}
