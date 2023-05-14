<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Twitter</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://use.fontawesome.com/releases/v6.4.0/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/timeline.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>
</head>
<body>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        {{-- <x-application-logo class="block h-10 w-auto fill-current text-gray-600" /> --}}
                        <i class="fa-brands fa-twitter"></i>
                    </a>
                </div>
            </div>
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    <div class="wrapper">
        <form action="/timeline" method="post">
            @csrf
            <div class="post-box">
                <input type="text" name="tweet" placeholder="今何してる？">
                <button type="submit" class="submit-btn">ツイート</button>
            </div>
        </form>
        <div class="tweet-wrapper">
            @foreach($tweets as $tweet)
            <div class="tweet-box">
                <a href="{{ route('show', [$tweet->user->id]) }}">
                    <img src="{{ asset('storage/images/'. $tweet->user->avatar) }}" alt="">
                </a>
                <div>{{ $tweet->tweet }}</div>
                <div class="destroy-btn">
                    @if($tweet->user_id === Auth::id())
                        <form action="{{ route('destroy', [$tweet->id]) }}" method="post">
                            @csrf
                            {{-- @method('delete') --}}
                            <input type="submit" value="削除">
                        </form>
                    @endif
                </div>
            </div>
            <div class="padding: 10px 40px">
                @if($tweet->likedBy(Auth::user())->count() > 0)
                    <a href="/likes/{{ $tweet->likedBy(Auth::user())->firstOrFail()->id }}"><i class="fa-sharp fa-solid fa-thumbs-down"></i></a>
                @else
                    <a href="/tweets/{{ $tweet->id }}/likes"><i class="fa-sharp fa-solid fa-thumbs-up"></i></a>
                @endif
                {{ $tweet->likes->count() }}
            @endforeach
            <div class="pagination">
                {{ $tweets->links() }}
            </div>
            </div>
        </div>
    </div>
</body>
</html>