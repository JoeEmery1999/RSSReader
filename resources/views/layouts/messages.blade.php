@if(\Illuminate\Support\Facades\Session::has('message')
    || \Illuminate\Support\Facades\Session::has('danger-message')
    || \Illuminate\Support\Facades\Session::has('info-message')
    || \Illuminate\Support\Facades\Session::has('warning-message')
    || \Illuminate\Support\Facades\Session::has('success-message'))
    <div class="row">
        <div class="col-md-12">
            @if(\Illuminate\Support\Facades\Session::has(['message']))
            <div class="flex items-center bg-blue-500 text-white text-sm font-bold px-4 py-3" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                </svg>
                <p> {!! \Illuminate\Support\Facades\Session::get('message') !!}</p>
            </div>
            @endif
            @if(\Illuminate\Support\Facades\Session::has(['info-message']))
            <div class="flex items-center bg-blue-500 text-white text-sm font-bold px-4 py-3" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                </svg>
                <p> {!! \Illuminate\Support\Facades\Session::get('info-message') !!}</p>
            </div>
            @endif
            @if(\Illuminate\Support\Facades\Session::has(['danger-message']))
            <div class="flex items-center bg-red-500 text-white text-sm font-bold px-4 py-3" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <p> {!! \Illuminate\Support\Facades\Session::get('danger-message') !!}</p>
            </div>
            @endif
            @if(\Illuminate\Support\Facades\Session::has(['warning-message']))
            <div class="flex items-center bg-yellow-500 text-white text-sm font-bold px-4 py-3" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                <p> {!! \Illuminate\Support\Facades\Session::get('warning-message') !!}</p>
            </div>
            @endif
            @if(\Illuminate\Support\Facades\Session::has(['success-message']))
            <div class="flex items-center bg-green-500 text-white text-sm font-bold px-4 py-3" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                </svg>
                <p>{!! \Illuminate\Support\Facades\Session::get('success-message') !!}</p>
            </div>
            @endif
        </div>
    </div>
@endif
