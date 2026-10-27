<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'description'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            if (empty($category->slug)) {
                $slug  = Str::slug($category->name);
                $count = 2;
                $original = $slug;

                while (static::where('slug', $slug)->exists()) {
                    $slug = "{$original}-{$count}";
                    $count++;
                }

                $category->slug = $slug;
            }
        });
    }

    // ==========================================
    // RELATIONSHIPS
    // ==========================================

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function publishedCourses()
    {
        return $this->hasMany(Course::class)->where('status', 'published');
    }
}
