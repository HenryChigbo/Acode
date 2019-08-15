<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class UserLesson
 *
 * @package App
 * @property string $users
 * @property string $lesson
*/
class UserLesson extends Model
{
    use SoftDeletes;

    protected $fillable = ['users_id', 'lesson_id'];
    protected $hidden = [];
    
    

    /**
     * Set to null if empty
     * @param $input
     */
    public function setUsersIdAttribute($input)
    {
        $this->attributes['users_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setLessonIdAttribute($input)
    {
        $this->attributes['lesson_id'] = $input ? $input : null;
    }
    
    public function users()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
    
    public function lesson()
    {
        return $this->belongsTo(Lesson::class, 'lesson_id')->withTrashed();
    }
    
}
