<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    //The table's name will be products
    protected $table = 'products';

    //The fields susceptible of being filled will be these
    protected $fillable = [
        'article_number',
        'article_name',
        'manufacturer',
        'description',
        'article_information',
        'gender',
        'product_type',
        'sleeves',
        'legs',
        'collar',
        'manufacture',
        'bag_type',
        'grammage',
        'material',
        'country_of_origin',
        'image_name',
    ];
}
