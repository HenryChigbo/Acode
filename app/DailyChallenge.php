<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class DailyChallenge
 *
 * @package App
 * @property string $name
 * @property string $description
 * @property string $image
*/
class DailyChallenge extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'description', 'image'];
    protected $hidden = [];
    
    
    
}
