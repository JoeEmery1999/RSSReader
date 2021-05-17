<div class="modal opacity-0 pointer-events-none absolute w-full h-full top-0 left-0 flex items-center justify-center">
    <div class="modal-overlay absolute w-full h-full bg-black opacity-25 top-0 left-0 cursor-pointer"></div>
    <div class="absolute w-4/5 h-auto sm:w-1/2 md:h-32 bg-white rounded-sm shadow-lg flex items-center justify-center text-2xl p-5">
        <form method="get" action="{{ route('subscribe') }}" class="w-4/5">
            @csrf
            <div class="flex flex-col md:flex-row">
                <input type="text" placeholder="www.domain.com/feed.rss" name="rss_url" class="rounded-sm flex-grow" />
                <button type="submit" class="md:ml-2 mt-1 sm:mt-0 bg-yellow-300 hover:bg-yellow-400 transition-colors duration-200 rounded-sm font-semibold py-2 px-4 text-center">Subscribe</button>
            </div>
        </form>
    </div>
</div>
