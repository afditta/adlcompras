<x-app-layout>

    <div class="container py-8">
        <figure class="mb-4">
            <img class="w-full object-cover object-center" src="{{ Storage::url($category->image) }}" alt="">
        </figure>


        @livewire('category-filter', ['category' => $category])

    </div>

</x-app-layout>
