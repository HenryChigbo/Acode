<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Banner
 *
 * @package App
 * @property string $photo_one
 * @property string $photo_two
 * @property string $photo_three
 * @property string $photo_four
 * @property string $photo_five
*/
class Banner extends Model
{
    use SoftDeletes;

    protected $fillable = ['photo_one', 'photo_two', 'photo_three', 'photo_four', 'photo_five'];
    protected $hidden = [];
    
    
    
}
