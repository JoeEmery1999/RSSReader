<x-app-layout>
    <x-slot name="header">
        <div class=" flex flex-row items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight flex-grow flex-middle">
                {{ __("Feed | {$parsed_feed->channel->title}") }}
            </h2>
            <a href="{{route('unsubscribe', $subscribed_feed->getID())}}" class="bg-yellow-300 hover:bg-red-400 transition-colors duration-200 rounded-sm font-semibold text-center p-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                </svg>
                <span class="inline">{{ __('Unsubscribe') }}</span>
            </a>
        </div>
    </x-slot>

    <div class="pb-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden border-b border-gray-300">
                <div class="p-6">
                    @if (empty($parsed_feed->channel->item))
                        <p>{{ __('We can\'t find any articles!') }}</p>
                    @endif

                    @foreach ($parsed_feed->channel->item as $key => $item)
                        <a href="{{$item->link}}" class="">
                            <div class="my-2 bg-yellow-300 bg-opacity-50 border-l-4 border-yellow-300 hover:border-yellow-400 hover:bg-opacity-25 transition-colors duration-200 font-semibold">
                            <div class="flex">
                                    <div class="flex flex-col flex-grow p-3">
                                        <div class="flex">
                                            <div class="flex-grow">
                                                <h2 class="text-xl border-b border-yellow-300 feed-title">
                                                    {{ $item->title }}
                                                </h2>
                                            </div>
                                            <span class="float-right">
                                                {{ __('Published: ') }}
                                                <span>
                                                    {{ $item->pubDate }}
                                                </span>
                                            </span>
                                        </div>
                                        <p class="">{{ $item->description }}</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
