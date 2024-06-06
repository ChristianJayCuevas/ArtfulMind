<x-showlayout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Post') }}
        </h2>

    </x-slot>
    <form method="POST" action="{{ route('createPost') }}"  enctype="multipart/form-data">
        @csrf
        <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-3">
            <h1 class="title">Upload file</h1>
            <input type="file" name="file_upload" id="file_upload" accept="image/*" onchange="previewImage(event)">
            <x-input-error :messages="$errors->get('file_upload')" class="mt-2" />
            <img id="image_preview" src="#" alt="Image Preview" style="display: none; width: 200px; height: auto; margin-top: 10px;">
        </div>
        <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-3">
            <textarea
                name="message_title"
                id = "message_title"
                placeholder="{{ __('Title') }}"
                class="block w-full h-10 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-100 focus:ring-opacity-50 rounded-md shadow-sm"
            >{{ old('message_title') }}</textarea>
            <x-input-error :messages="$errors->get('message_title')" class="mt-2" />
        </div>
        <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-3">

            <textarea
                name="post_message"
                id = "post_message"
                placeholder="{{ __('What\'s on your mind?') }}"
                class="block w-full h-40 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
            >{{ old('post_message') }}</textarea>
            <x-input-error :messages="$errors->get('post_message')" class="mt-2" />
            <x-primary-button class="mt-4">{{ __('Post') }}</x-primary-button>
        </div>
    </form>
    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function(){
                var output = document.getElementById('image_preview');
                output.src = reader.result;
                output.style.display = 'block';
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</x-showlayout>
