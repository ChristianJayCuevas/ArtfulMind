<x-showlayout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Post') }}
        </h2>
    </x-slot>
    <form method="POST" action='/post/{{ $post->id }}' id="edit-form">
        @csrf
        @method('PATCH')
            <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-3">
                <h1 class="title">Upload file</h1>
                <input type="file" name="file_upload" id="file_upload" accept="image/*" onchange="previewImage(event)">
                @if($post->image_url)   
                    <div id="image_container">
                        <img class="rounded w-full" src="{{ asset('storage/' . $post->image_url) }}">
                    </div>
                @endif
                </input>
                <x-input-error :messages="$errors->get('file_upload')" class="mt-2" />
                <img id="image_preview" src="#" alt="Image Preview" style="display: none; width: 200px; height: auto; margin-top: 10px;">
            </div>
            <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-3">
                <textarea
                    name="title"
                    id = "title"
                    placeholder="{{ __('Title') }}"
                    class="block w-full h-10 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-100 focus:ring-opacity-50 rounded-md shadow-sm"
                    >{{ $post->title }}</textarea>
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>
            <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-3">
                
                <textarea
                    name="description"
                    id = "description"
                    placeholder="{{ __('What\'s on your mind?') }}"
                    class="block w-full h-40 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                    >{{ $post->description }}</textarea>
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                <x-primary-button form="edit-form" class="mt-4">{{ __('Edit') }}</x-primary-button>
                <x-danger-button form="delete-form" class="ms-3">
                    {{ __('Delete') }}
                </x-danger-button>
            </div>
    </form>
    <form method="POST" action="/post/{{ $post->id }}" id="delete-form" class="hidden" >
        @csrf
        @method('DELETE')
    </form>
    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('image_container');
                if (output) {
                    output.innerHTML = '<img class="rounded w-full" src="' + reader.result + '">';
                } else {
                    output = document.createElement('div');
                    output.id = 'image_container';
                    output.innerHTML = '<img class="rounded w-full" src="' + reader.result + '">';
                    document.body.appendChild(output);
                }
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</x-showlayout>