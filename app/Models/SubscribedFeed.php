<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $user_id
 * @property int $feed_id
 * @property DateTime $last_viewed
 * @property DateTime $created_at
 * @property DateTime $updated_at
 */
class SubscribedFeed extends Model
{
    use HasFactory;

    protected $table = 'subscribed_feeds';

    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'feed_id',
        'last_viewed'
    ];

    protected $casts = [
        'user_id'     => 'integer',
        'feed_id'     => 'integer',
        'last_viewed' => 'datetime',
        'created_at'  => 'datetime',
        'updated_at'  => 'datetime'
    ];

    //Business logic

    /**
     * @return string
     */
    public function getFormattedLastViewed(): string
    {
        if ($this->getLastViewed() !== null)
        {
            return $this->getLastViewed()->format('D jS M, Y');
        }

        return '-';
    }

    //Base getters and setters

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * @param int $user_id
     * @return SubscribedFeed
     */
    public function setUserId(int $user_id): SubscribedFeed
    {
        $this->user_id = $user_id;
        return $this;
    }

    /**
     * @return int
     */
    public function getFeedId(): int
    {
        return $this->feed_id;
    }

    /**
     * @param int $feed_id
     * @return SubscribedFeed
     */
    public function setFeedId(int $feed_id): SubscribedFeed
    {
        $this->user_id = $feed_id;
        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getLastViewed(): ?DateTime
    {
        return $this->last_viewed;
    }

    /**
     * @param DateTime $last_viewed
     * @return SubscribedFeed
     */
    public function setLastViewed(DateTime $last_viewed): SubscribedFeed
    {
        $this->last_viewed = $last_viewed;
        return $this;
    }

    //Relationships

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function feed(): BelongsTo
    {
        return $this->belongsTo(Feed::class, 'feed_id');
    }
}
