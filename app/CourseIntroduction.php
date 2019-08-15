<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class CourseIntroduction
 *
 * @package App
 * @property string $title
 * @property string $description
 * @property string $course_key
*/
class CourseIntroduction extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'description', 'course_key_id'];
    protected $hidden = [];
    
    

    /**
     * Set to null if empty
     * @param $input
     */
    public function setCourseKeyIdAttribute($input)
    {
        $this->attributes['course_key_id'] = $input ? $input : null;
    }
    
    public function course_key()
    {
        return $this->belongsTo(Course::class, 'course_key_id')->withTrashed();
    }
    
}
