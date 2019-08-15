<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Discussion
 *
 * @package App
 * @property string $question
 * @property enum $tags
 * @property string $description
 * @property string $post
 * @property string $user
*/
class Discussion extends Model
{
    use SoftDeletes;

    protected $fillable = ['question', 'tags', 'description', 'post', 'user_id'];
    protected $hidden = [];
    
    

    public static $enum_tags = ["Android" => "Android", "iOS" => "IOS", "Flutter" => "Flutter", "React Native" => "React Native", "Xamarin" => "Xamarin"];

    /**
     * Set to null if empty
     * @param $input
     */
    public function setUserIdAttribute($input)
    {
        $this->attributes['user_id'] = $input ? $input : null;
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
}
