<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class DiscussionFlag
 *
 * @package App
 * @property string $discussion
 * @property string $user
 * @property integer $counter
*/
class DiscussionFlag extends Model
{
    use SoftDeletes;

    protected $fillable = ['counter', 'discussion_id', 'user_id'];
    protected $hidden = [];
    
    

    /**
     * Set to null if empty
     * @param $input
     */
    public function setDiscussionIdAttribute($input)
    {
        $this->attributes['discussion_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setUserIdAttribute($input)
    {
        $this->attributes['user_id'] = $input ? $input : null;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setCounterAttribute($input)
    {
        $this->attributes['counter'] = $input ? $input : null;
    }
    
    public function discussion()
    {
        return $this->belongsTo(Discussion::class, 'discussion_id')->withTrashed();
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
}
