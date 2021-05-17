<x-app-layout>
    <x-slot name="header">
        <div class=" flex flex-row items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight flex-grow flex-middle">
                {{ __('Dashboard') }}
            </h2>
            <button class="modal-button bg-yellow-300 hover:bg-yellow-400 transition-colors duration-200 rounded-sm font-semibold text-center p-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                <span class="inline">{{ __('Add a new feed') }}</span>
            </button>
        </div>
    </x-slot>

    <div class="pb-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden border-b border-gray-300">
                <div class="p-6">
                    @if ($user->subscribedFeeds->isEmpty())
                        <p>{{ __('You don\'t appear to have any feeds!') }}</p>
                    @endif

                    @php /** @var App\Models\SubscribedFeed $subscribed_feed */ @endphp
                    @foreach ($user->subscribedFeeds as $key => $subscribed_feed)
                        @php
                            /** @var App\Models\Feed $feed */
                            $feed = $subscribed_feed->feed()->get()->first();
                        @endphp
                        <a href="{{route('feed', $subscribed_feed->getId())}}" class="block">
                            <div class="my-2 bg-yellow-300 bg-opacity-50 border-l-4 border-yellow-300 hover:border-yellow-400 hover:bg-opacity-25 transition-colors duration-200 font-semibold">
                                <div class="flex">
                                @if($feed->getImageUrl() !== null)
                                    <div class="feed-image flex-none bg-center bg-no-repeat bg-contain" style="background-image: url({{ $feed->getImageUrl() }})">
                                    </div>
                                @endif
                                    <div class="flex flex-col flex-grow p-3">
                                        <div>
                                            <h2 class="text-xl border-b border-yellow-300 feed-title">
                                                {{ $feed->getTitle() }}
                                            </h2>
                                            <span>
                                                {{' - ' . $feed->getLink() }}
                                            </span>
                                            <span class="float-right">
                                                {{ __('Last Read: ') }}
                                                <span>
                                                    {{ $subscribed_feed->getFormattedLastViewed() }}
                                                </span>
                                            </span>
                                        </div>
                                        <p class="">{{ $feed->getDescription() }}</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        @endforeach
                </div>
            </div>
        </div>
    </div>
    @include('components/feed-subscribe')
</x-app-layout>
