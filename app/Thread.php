<?php

namespace App;

use App\Events\ThreadReceivedNewReply;
use App\Filters\ThreadFilters;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use App\Reputation;
use Stevebauman\Purify\Purify;

class Thread extends Model
{
    use RecordsActivity, Searchable;

    /**
     * Don't auto-apply mass assignment protection.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The relationships to always eager-load.
     *
     * @var array
     */
    protected $with = ['creator', 'channel'];
    protected $appends = ['isSubscribedTo'];
    protected $casts = [
        'locked' => 'boolean',
        'pinned' => 'boolean'
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('replyCount', function ($builder) {
            $builder->withCount('replies');
        });

        static::deleting(function ($thread) {
            $thread->replies->each->delete();
            Reputation::deduct($thread->creator, Reputation::THREAD_WAS_PUBLISHED);
        });

        static::created(function ($thread){
            $thread->update(['slug' => $thread->title]);

            Reputation::award($thread->creator, Reputation::THREAD_WAS_PUBLISHED);
        });
    }

    /**
     * Get a string path for the thread.
     *
     * @return string
     */
    public function path()
    {
        return "/threads/{$this->channel->slug}/{$this->slug}";
    }

    /**
     * A thread belongs to a creator.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * A thread is assigned a channel.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function channel()
    {
        return $this->belongsTo(Channel::class)->withoutGlobalScope('active');
    }

    /**
     * A thread may have many replies.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    /**
     * Add a reply to the thread.
     *
     * @param $reply
     */
    public function addReply($reply)
    {
        $reply =  $this->replies()->create($reply);

        event(new ThreadReceivedNewReply($reply));

        return $reply;
    }

    /**
     * Apply all relevant thread filters.
     *
     * @param  Builder       $query
     * @param  ThreadFilters $filters
     * @return Builder
     */
    public function scopeFilter($query, ThreadFilters $filters)
    {
        return $filters->apply($query);
    }

    public function subscribe($userId = null)
    {
        $this->subscriptions()->create([
            'user_id' => $userId?: auth()->id()
        ]);

        return $this;
    }

    public function unsubscribe($userId = null)
    {
        $this->subscriptions()
        ->where('user_id', $userId ?: auth()->id())
        ->delete();
    }

    public function subscriptions()
    {
        return $this->hasMany(ThreadSubscription::class);
    }

    public function getIsSubscribedToAttribute()
    {
        return $this->subscriptions()
            ->where('user_id', auth()->id())
            ->exists();
    }

    public function hasUpdatesFor($user)
    {
        $key = $user->visitedThreadCacheKey($this);
        return $this->updated_at > cache($key);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function setSlugAttribute($value)
    {
        if(static::whereSlug($slug = str_slug($value))->exists()){
            $slug = $this->incrementSlug($slug);
        }

        $this->attributes['slug'] = $slug;
    }

    public function incrementSlug($slug)
    {

        if(static::whereSlug($slug)->exists())
        {
            $slug = "{$slug}-" . $this->id;
        }

        return $slug;
    }

    public function markBestReply(Reply $reply)
    {
        $this->update([
            'best_reply_id' => $reply->id
        ]);

        Reputation::award($reply->owner, Reputation::REPLY_WAS_MARKED_AS_BEST);
    }

    public function toSearchableArray()
    {
        return $this->toArray() + ['path' => $this->path()];
    }

    public function getBodyAttribute($body)
    {
        return \Purify::clean($body);
    }

    public function bestReply()
    {
        return $this->hasOne(Reply::class, 'thread_id');
    }

    public function removeBestReply(Reply $reply)
    {
        Reputation::deduct($reply->owner, Reputation::REPLY_WAS_MARKED_AS_BEST);
        $this->update(['best_reply_id' => null]);
    }

    public function scopeThisYear($query){
        return $query->where('created_at', '>=', Carbon::now()->firstOfYear());
    }


}
