<x-showlayout>
    <div class="flex flex-col items-center mx-auto px-4">
        <div class="flex flex-col items-center bg-white rounded-lg shadow-md overflow-hidden w-full md:w-2/3 lg:w-1/2">
            <div class="relative w-full">
                <div class="h-48 bg-gray-300 cursor-pointer" onclick="document.getElementById('cover-photo-upload').click()">
                    <img id="cover-photo-preview" class="w-full h-full object-cover" src="{{ $user->coverPhoto ?? '/default-cover.jpg' }}" alt="Cover Photo">
                </div>
                <div class="absolute bottom-0 transform -translate-x-1/2 translate-y-1/2 left-1/2">
                    <div class="w-32 h-32 rounded-full overflow-hidden border-4 border-white bg-black cursor-pointer" onclick="document.getElementById('profile-photo-upload').click()">
                        <img id="profile-photo-preview" class="w-full h-full object-cover" src="{{ $user->profilePicture ?? '/default-profile.jpg' }}" alt="Profile Picture">
                    </div>
                </div>
            </div>
            <div class="p-6 w-full">
                <div class="text-center mb-4 mt-12">
                    <h2 class="text-2xl font-bold">{{ $user->name }}</h2>
                    <p class="text-gray-600">{{ $user->bio }}</p>
                </div>
                <div class="flex justify-center space-x-4">
                    <div class="text-center">
                        <span class="text-gray-600">Tweets</span>
                        <strong class="block">{{ $user->tweets_count }}</strong>
                    </div>
                    <div class="text-center">
                        <span class="text-gray-600">Following</span>
                        <strong class="block">{{ $user->following_count }}</strong>
                    </div>
                    <div class="text-center">
                        <span class="text-gray-600">Followers</span>
                        <strong class="block">{{ $user->followers_count }}</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form id="upload-form" action="{{ route('upload.profile.cover') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" id="cover-photo-upload" name="cover_photo" style="display: none;" onchange="previewCoverPhoto(this)">
        <input type="file" id="profile-photo-upload" name="profile_photo" style="display: none;" onchange="previewProfilePhoto(this)">
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Upload Photos</button>
    </form>
</x-showlayout>
<script>
    function previewCoverPhoto(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('cover-photo-preview').src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function previewProfilePhoto(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('profile-photo-preview').src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
