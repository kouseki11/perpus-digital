<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function loan() {
        return $this->hasMany(Loan::class);
    }

    public function review() {
        return $this->hasMany(Review::class);
    }

    public function collection() {
        return $this->hasMany(Collection::class);
    }

    public function BookCategory() {
        return $this->hasMany(BookCategory::class);
    }
}
