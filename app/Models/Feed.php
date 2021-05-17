<?php

namespace App\Models;

use App\Helpers\RSSHelper;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Mockery\Exception;
use SimpleXMLElement;

/**
 * @property int $id
 * @property string $url
 * @property string $title
 * @property string $link
 * @property string $description
 * @property string $image
 * @property DateTime $last_viewed
 * @property DateTime $created_at
 * @property DateTime $updated_at
 */
class Feed extends Model
{
    use HasFactory;

    protected $table = 'feeds';

    protected $fillable = [
        'url',
        'title',
        'link',
        'description',
        'image',
    ];

    protected $casts = [
        'url'         => 'string',
        'title'       => 'string',
        'description' => 'string',
        'image'       => 'string',
        'created_at'  => 'datetime',
        'updated_at'  => 'datetime'
    ];

    //Business Logic

    /**
     * Function tht will attempt to subscribe the current user to this feed. Will also supply user feedback as such.
     *
     * @return mixed
     */
    public function subscribe()
    {
        try {
            $subscribed_feed = SubscribedFeed::firstOrCreate([
                'user_id' => Auth::id(),
                'feed_id' => $this->getId(),
            ]);

            if (!$subscribed_feed->wasRecentlyCreated) {
                Session::flash('info-message', 'You have already subscribed to this feed!');
                return true;
            }

            Session::flash('success-message', 'Successfully subscribed to feed!');
            return true;

        } catch (Exception $exception) {
            Session::flash('danger-message', 'An error occurred, please try again.');
            return false;
        }
    }

    /**
     * Simple function that passes the URL of the current instance to
     * SimpleXMLElement and returns a traversable object.
     *
     * @return SimpleXMLElement
     */
    public function getFeedContents()
    {
        return new SimpleXMLElement($this->getUrl(), 0, true);
    }

    public function getImageUrl()
    {
        return json_decode($this->getImage(), true)['image_url'];
    }

    public function setImageUrl(string $image_url)
    {
        $image = json_decode($this->getImage(), true);
        $image['image_url'] = $image_url;

        $this->setImage(json_encode($image));

        return $this;
    }

    public function getImageTitle()
    {
        return json_decode($this->getImage(), true)['image_title'];
    }

    public function setImageTitle(string $image_title)
    {
        $image = json_decode($this->getImage(), true);
        $image['image_title'] = $image_title;

        $this->setImage(json_encode($image));

        return $this;
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
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return Feed
     */
    public function setUrl(string $url): Feed
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Feed
     */
    public function setTitle(string $title): Feed
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getLink(): string
    {
        return $this->link;
    }

    /**
     * @param string $link
     * @return Feed
     */
    public function setLink(string $link): Feed
    {
        $this->link = $link;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Feed
     */
    public function setDescription(string $description): Feed
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getImage(): string
    {
        return $this->image;
    }

    /**
     * @param string $image
     * @return Feed
     */
    public function setImage(string $image): Feed
    {
        $this->image = $image;
        return $this;
    }

    //Relationships

    /**
     * @return HasMany
     */
    public function feeds(): HasMany
    {
        return $this->hasMany(SubscribedFeed::class, 'feed_id', 'id');
    }
}
