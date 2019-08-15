<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class DailyChallengeFlag
 *
 * @package App
 * @property integer $counter
 * @property string $daily_challenge
*/
class DailyChallengeFlag extends Model
{
    use SoftDeletes;

    protected $fillable = ['counter', 'daily_challenge_id'];
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
    public function setDailyChallengeIdAttribute($input)
    {
        $this->attributes['daily_challenge_id'] = $input ? $input : null;
    }
    
    public function daily_challenge()
    {
        return $this->belongsTo(DailyChallenge::class, 'daily_challenge_id')->withTrashed();
    }
    
}
