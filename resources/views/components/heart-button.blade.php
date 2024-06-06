
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
crossorigin="anonymous" referrerpolicy="no-referrer" />

<div>
    @if(Auth::user()->likesIdea($post))
        <form action="{{ route('unlike', $post->id) }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="fw-light nav-link fs-6"> <span class="fas fa-thumbs-up me-1">
                </span> {{ $post->likes()->count() }} </button>
        </form>
    @else
        <form action="{{ route('like', $post->id) }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="fw-light nav-link fs-6"> <span class="far fa-thumbs-up me-1">
            </span> {{ $post->likes()->count() }} </button>
        </form>
    @endif
</div>
