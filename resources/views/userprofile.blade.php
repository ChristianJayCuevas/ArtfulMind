<x-showlayout>
    <div class="flexbox-container">
        <div class="flexbox-item flexbox-item-1 flex-col">
            @if($user->UserProfile == null)
            <div class="mt-2 mb-10 flex justify-center">
                <div class="image-container w-full md:w-full">
                    <img src="{{ asset(str_replace('public', 'storage', $post->image_url))  }}" class="rounded-lg object-contain h-full w-full" alt="Post Image">
                </div>
            </div>
            <div class="mt-2 mb-10 flex justify-start">
                <div class="border-solid border-2 rounded-full bg-white">
                    <img src="{{ asset(str_replace('public', 'storage', $post->image_url))  }}" class="rounded-lg object-contain h-full w-full" alt="Post Image">
                </div>
            </div>
            @endif
            
            <h2 class="titlecard mt-2">
                {{ $user->name }}
            </h2>
            <p class="sub_titlecard mt-2 mb-10">
                Placeholder
            </p>
        
            <p class="text-gray-700 dark:text-gray-300 mt-2 mb-4">
                <a href="/post/{{ $post->id }}/edit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline">
                    Edit
                </a>
            </p>
        
        </div>

        <div class="flexbox-item flexbox-item-2">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mb-4">
                Comments
            </h2>
            @foreach($post->Comment as $comment)
            <!--bg-gray-100 dark:bg-gray-700 p-4 rounded-lg mb-4 w-full-->
                <div class="flexbox-item flexbox-item-3">
                    <p class="text-gray-700 dark:text-gray-300 font-bold mb-2">
                        {{ $comment->User->name }}
                    </p>
                    <p class="text-gray-700 dark:text-gray-300">
                        {{ $comment->comments }}
                    </p>
                </div>
            @endforeach

            <div class="flexbox-item flexbox-item-3">
                <form method="POST" action="{{ route('createComment') }}">
                    @csrf
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                        <div class="mb-4">
                            <label for="comment" class="block text-gray-700 dark:text-gray-300 mb-2">Add a comment</label>
                            <textarea id="comment" name="comment" rows="3" class="w-full px-3 py-2 text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 dark:focus:ring-blue-500" required></textarea>
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline">
                                Submit
                            </button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</x-showlayout>