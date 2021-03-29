@extends('layout', ['title' => 'Posts'])

@section('content')

<main class="px-4 sm:px-6 lg:pb-28 lg:px-8">
    <div class="max-w-5xl mx-auto">
        <div class = "page-header text-center">
            <h1>
                The Eloquent Blog
                {{-- <small>Subtext for header</small> --}}
            </h1>
        </div>
        <div class="mt-2 flex flex-wrap">
            @foreach ($posts as $post)
                <div class="mt-4 w-full sm:w-1/2 ">
                    <a href="#" class="text-gray-900 font-medium hover:underline">
                        {{ $post->title }}
                    </a>
                    <div class="text-sm text-gray-500">
                        Posted {{ $post->updated_at->toFormattedDateString() }} by {{ $post->author->name }}
                        
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="mt-4">
        {{ $posts->links() }}
    </div>
</main>

@endsection