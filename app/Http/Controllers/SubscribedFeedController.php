<?php

namespace App\Http\Controllers;

use App\Models\SubscribedFeed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SubscribedFeedController extends Controller
{
    public function displayFeed(Request $request, int $id)
    {
        $user = Auth::user();
        $subscribed_feed = SubscribedFeed::find($id);

        if ($subscribed_feed === null)
        {
            Session::flash('warning-message', 'That feed does not exist!');
            return redirect()->route('dashboard');
        }

        $parsed_feed = $subscribed_feed->feed->getFeedContents();

        $subscribed_feed
            ->setLastViewed(new \DateTime())
            ->update();

        return view('feed.feed', compact(
            'user',
            'subscribed_feed',
            'parsed_feed'
        ));
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function unsubscribe(Request $request, int $id)
    {
        $subscribed_feed = SubscribedFeed::find($id);
        $subscribed_feed_url = $subscribed_feed->feed->getURL();

        if ($subscribed_feed->delete())
        {
            Session::flash('warning-message', "Successfully unsubscribed from feed: $subscribed_feed_url");
            return redirect()->route('dashboard');
        }

        return false;
    }
}
