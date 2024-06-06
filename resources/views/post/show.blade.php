<style>
    .image-container {
        position: relative;
        padding-bottom: 50.25%; /* 16:9 aspect ratio (change as needed) */
        background-color: black;
        overflow: hidden;
        border-radius: 10px;
    }

    .image-container img {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        max-width: 100%;
        max-height: 100%;
        /* Adjust blur effect as needed */
    }
</style>
<x-showlayout>
    <div class="flexbox-container">
        <div class="flexbox-item flexbox-item-1">
            <h2 class="titlecard mt-2">
                {{ $post->title }}
            </h2>
            <p class="sub_titlecard mt-2 mb-10">
                {{ $post->description }}
            </p>
            @if($post->image_url)
            <div class="mt-2 mb-10 flex justify-center">
                <div class="image-container w-full md:w-full">
                    <img src="{{ asset(str_replace('public', 'storage', $post->image_url))  }}" class="rounded-lg object-contain h-full w-full" alt="Post Image">
                </div>
            </div>
            @endif
            @if($post->USER_ID === $user->id)
                <p class="text-gray-700 dark:text-gray-300 mt-2 mb-4">
                    <a href="/post/{{ $post->id }}/edit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline">
                        Edit
                    </a>
                </p>
            @endif
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
