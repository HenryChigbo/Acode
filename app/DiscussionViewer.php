<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class DiscussionViewer
 *
 * @package App
 * @property string $discussion
 * @property integer $counter
*/
class DiscussionViewer extends Model
{
    use SoftDeletes;

    protected $fillable = ['counter', 'discussion_id'];
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
    
}
