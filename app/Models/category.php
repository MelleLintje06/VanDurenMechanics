<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'categoryID';
    // protected $fillable = [
    //     'categoryName',
    //     'categorySlug',
    //     'createdBy',
    //     'categoryImage',
    //     'categoryStatus',
    // ];
}
