<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Lesson
 *
 * @package App
 * @property string $name
 * @property string $description
 * @property string $content
 * @property string $prerequisite
 * @property string $avatar
 * @property string $color_background
 * @property string $color_foreground
*/
class Lesson extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'description', 'content', 'prerequisite', 'avatar', 'color_background', 'color_foreground'];
    protected $hidden = [];
    
    
    
}
