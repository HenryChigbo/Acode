<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class DailyChallengeComment
 *
 * @package App
 * @property string $comment
 * @property string $daily_challenge
 * @property string $user
*/
class DailyChallengeComment extends Model
{
    use SoftDeletes;

    protected $fillable = ['comment', 'daily_challenge_id', 'user_id'];
    protected $hidden = [];
    
    

    /**
     * Set to null if empty
     * @param $input
     */
    public function setDailyChallengeIdAttribute($input)
    {
        $this->attributes['daily_challenge_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setUserIdAttribute($input)
    {
        $this->attributes['user_id'] = $input ? $input : null;
    }
    
    public function daily_challenge()
    {
        return $this->belongsTo(DailyChallenge::class, 'daily_challenge_id')->withTrashed();
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
}
