@foreach($posts as $post)
    <div class="bg-white p-6 rounded-xl shadow mb-4">
        <h3 class="text-lg font-bold">{{ $post->title }}</h3>

        <div class="mt-4 flex gap-4">
            <a href="{{ route('posts.edit', $post) }}"
               class="text-blue-600 hover:underline">
                Edit
            </a>

            <form action="{{ route('posts.destroy', $post) }}"
                  method="POST"
                  onsubmit="return confirm('Delete this article?')">
                @csrf
                @method('DELETE')

                <button class="text-red-600 hover:underline">
                    Delete
                </button>
            </form>
        </div>
    </div>
@endforeach
