@auth
    <x-panel>
        <form action="/posts/{{ $post->slug }}/comments" method="POST">
            @csrf
            <header class="flex align-items-center">
                <img src="https://i.pravatar.cc/60?u={{ auth()->id() }}" alt="" width="40" height="60"
                    class="rounded-full">
                <h2 class="ml-3">Want to participated ?</h2>
            </header>

            <div class="mt-6">
                <textarea name="body" rows="5" class="w-full text-sm focus:outline-none focus:ring"
                    placeholder="Something you wanna to say ?" required></textarea>

                @error('body')
                    <span class="text-xs text-red-500"> {{ $message }} </span>
                @enderror

            </div>


            <div class="flex justify-end mt-6 border-t border-gray-200 pt-6">
                <x-submit-button>Post Comment</x-submit-button>
            </div>
        </form>

    </x-panel>
@else
    <p class="font-semibold">
        <a href="/register" class="text-blue-500 hover:underline focus:underline">Register</a> or <a href="/login"
            class="text-blue-500 hover:underline focus:underline">Login</a> to
        participate in the
        dissussion
    </p>
@endauth
