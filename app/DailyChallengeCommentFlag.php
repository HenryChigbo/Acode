<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class DailyChallengeCommentFlag
 *
 * @package App
 * @property integer $counter
 * @property string $user
 * @property string $daily_challenge_comment
*/
class DailyChallengeCommentFlag extends Model
{
    use SoftDeletes;

    protected $fillable = ['counter', 'user_id', 'daily_challenge_comment_id'];
    protected $hidden = [];
    
    

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setCounterAttribute($input)
    {
        $this->attributes['counter'] = $input ? $input : null;
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
     * Set to null if empty
     * @param $input
     */
    public function setDailyChallengeCommentIdAttribute($input)
    {
        $this->attributes['daily_challenge_comment_id'] = $input ? $input : null;
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function daily_challenge_comment()
    {
        return $this->belongsTo(DailyChallengeComment::class, 'daily_challenge_comment_id')->withTrashed();
    }
    
}
