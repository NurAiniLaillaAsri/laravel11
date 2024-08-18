<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <section class="bg-white dark:bg-gray-900">
        {{-- @if(session()->has('success'))
        <div class="alert alert-success row justify-content-between" role="alert">
            {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss='alert' aria-label="Close"></button>
        </div>
        @endif --}}
        <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
            {{-- <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Add a new product</h2> --}}
            <form action="/myarticle/{{ $post->id }}" method="POST">
                @csrf
                @method('PUT')
                <div class="grid gap-4 sm:grid-cols-1 sm:gap-6">
                    <!-- Input Tersembunyi -->
                    <input type="hidden" name="author_id" value="{{ auth()->user()->id }}">
                    
                    <div class="sm:col-span-2">
                        <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                        <input type="text" name="title" id="title" class="@error('title') is-invalid @else is-valid @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Title" required="" value="{{ old('title', $post->title) }}">
                        @error('title')
                        <div class="invalid-feedback text-red-600 text-xs">
                            The title field does not match.
                        </div>
                        @enderror
                    </div>
                    <div class="sm:col-span-2">
                        <label for="slug" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Slug</label>
                        <input type="text" name="slug" id="slug" class="@error('slug') is-invalid @else is-valid @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Slug" required="" readonly value="{{ old('slug', $post->slug) }}">
                        @error('slug')
                        <div class="invalid-feedback text-red-600 text-xs">
                            The slug field does not match.
                        </div>
                        @enderror
                    </div>
                    <div>
                        <label for="category_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                        <select id="category_id" name="category_id" class="@error('category_id') is-invalid @else is-valid @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            @foreach ($categories as $category)
                                @if(old('category_id', $post->category_id) == $category->id)
                                <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                @else
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('category_id')
                        <div class="invalid-feedback text-red-600 text-xs">
                            The category field does not match.
                        </div>
                        @enderror
                    </div>
                    
                    <div class="sm:col-span-2">
                        <label for="body" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Article Content</label>
                        {{-- <textarea id="body" name="body" type="text" rows="8" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Article Content"></textarea> --}}
                        <input id="body" type="hidden" name="body" value="{{ old('body', $post->body) }}">
                        <trix-editor input="body"></trix-editor>
                    </div>
                </div>
                <button type="submit" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                    Add product
                </button>
            </form>
        </div>
      </section>

<script>
    const title = document.querySelector('#title');
    const slug = document.querySelector('#slug');

    title.addEventListener('change', function() {
        fetch('/addArticle/checkSlug?title=' + title.value)
        .then(response => response.json())
        .then(data => slug.value = data.slug)
    });

    document.addEventListener('trix-file-accept', function(e) {
        e.preventDefault();
    })
</script>
</x-layout>