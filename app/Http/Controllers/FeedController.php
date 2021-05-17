<?php

namespace App\Http\Controllers;

use App\Models\Feed;
use Exception;
use http\Url;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Helpers\RSSHelper;
use SimpleXMLElement;

class FeedController extends Controller
{

    /**
     * Given a request, this function will attempt to extract the 'rss_url'
     * field and validate it before attempting to subscribe to the rss feed via the feed model.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function requestCreateAndSubscribe(Request $request)
    {
        //Initial validation
        try {
            $this->validate($request, ['rss_url' => 'required|url']);
        } catch (Exception $exception) {
            Session::flash('warning-message', 'Please provide a valid rss source');
            return redirect()->route('dashboard');
        }
        if (!RSSHelper::validateRSSSource($request->rss_url))
        {
            Session::flash('warning-message', 'Please provide a valid rss source');
            return redirect()->route('dashboard');
        }

        //At this point we should atleast have valid XML/RSS
        //Does a feed already exist for this url?
        $existing_feed_builder = Feed::where('url', $request->rss_url);

        if($existing_feed_builder->count() > 0 && $existing_feed_builder->get()->first()->subscribe())
        {
            return redirect()->route('dashboard');
        }
        $rss_xml = RSSHelper::parseUrl($request->rss_url);

        //Lets pull out all this data, we need to cast to string here or sometimes we can end up
        // with something like "{"0": "This is the title of the feed"}" instead of just the title alone.
        $rss_url        = $request->rss_url;
        $title          = (string) ($rss_xml->title ?? '');
        $link           = (string) ($rss_xml->link ?? '');
        $description    = (string) ($rss_xml->description ?? '');
        $image_url      = (string) ($rss_xml->image->url ?? '');
        $image_title    = (string) ($rss_xml->image->title ?? '');

        /** @var Feed $new_feed */
        $new_feed = Feed::create([
            'user_id'       => $auth_id = Auth::id(),
            'url'           => $rss_url ?: null,
            'title'         => $title ?: null,
            'link'          => $link ?: null,
            'description'   => $description ?: null,
            'image' => json_encode([
                'image_url'     => $image_url ?: null,
                'image_title'   => $image_title ?: null,
            ]),
        ]);

        $new_feed->subscribe();

        return redirect()->route('dashboard');
    }
}
