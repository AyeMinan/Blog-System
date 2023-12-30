<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class Blog extends Model
{
    use HasFactory;

    public static function boot(){

        parent::boot();

        static::deleted(function($model){
            $model->comments()->delete();
            $model->subscribedUsers()->detach();
            File::delete(public_path($model->photo));

        });
    }

    protected $fillable = [
        "title", "slug" , "body", "category_id", "user_id" , "photo"];

    public function category(){
    return $this->belongsTo(Category::class);

    }

    public function comments(){
     return $this->hasMany(Comment::class);
    }

    public function subscribedUsers(){
        return $this->belongsToMany(User::class, 'blogs_users');
       }

    public function isSubscribedBy($user){

        return $this->subscribedUsers->contains('id', $user->id);
    }
     public function scopeFilter($query, $filters){
        if($filters['search'] ?? null){
            $query->where(function($query) use($filters){
            $query->where('title','LIKE','%'.$filters['search'].'%')
            ->orWhere('body', 'LIKE', '%'.$filters['search'].'%');
            });
        }
        if($filters['category'] ?? null){
            $query->whereHas('category', function ($catQuery) use ($filters){
                $catQuery->where('slug', $filters['category']);
            });
        }
        if($filters['user'] ?? null){
            $query->whereHas('user', function ($userQuery) use ($filters){
               $userQuery ->where('name', $filters['user']);
            });
        }

    }

    public function user()
{
    return $this->belongsTo(User::class);
}
}
