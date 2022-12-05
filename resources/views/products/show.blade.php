<x-app-layout>
    <div class="container py-4 ">
        <div class="flex grid grid-cols-1 md:grid-cols-2 gap-2 md:gap-6 ">
            <div class="grid xs:w-full lg:w-3/4 lg:mx-auto" style="">
                <div class="flexslider ">
                    <ul class="slides">
                        @foreach ($product->images as $image)
                        
                            <li data-thumb=" {{ Storage::url($image->url) }}">
                                <img src=" {{ Storage::url($image->url) }}" />
                            </li>

                        @endforeach
                        
                    </ul>
                </div>

            
            </div>

            <div class="-mt-12 md:mt-0 lg:mt-0 xl:mt-0" >
                <h1 class="text-xl font-bold text-trueGray-700">{{$product->name}}</h1>

                <div class="flex">
                    <p class="text-trueGray-700">Marca: <a class="underline capitalize hover:text-yellow-500" >{{ $product->brand->name }}</a></p>
                    {{-- <p class="text-trueGray-700 mx-6">5 <i class="fas fa-star text-sm text-yellow-400"></i></p>
                    <a class="text-yellow-400 hover:text-yellow-600 underline" href="">39 reseñas</a> --}}
                </div>

                <p class="text-2xl font-semibold text-trueGray-700 my-4">$ {{number_format( $product->price )}}</p>

                <div class="bg-white rounded-lg shadow-lg mb-6">
                    <div class="p-4 flex items-center">
                        <span class="flex items-center justify-center h-10 w-10 rounded-full bg-green-600">
                            <i class="fa-solid fa-truck-fast text-sm text-white"></i>
                            
                        </span>
                        <i class="fa-sharp fa-solid fa-moped"></i>
                        <div class="ml-4">
                            <p class="text-lg font-semibold text-green-600">Se hace envíos a todo Colombia </p>
                            <p>Recibelo el {{ Date::now()->addDay(5)->locale('es')->format('l j F') }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow-lg mb-6">
                    <div class="p-4 flex items-center">
                        <span class="flex items-center justify-center h-10 w-10 rounded-full bg-green-600">
                            <i class="fas fa-motorcycle text-white"></i>
                            
                        </span>
                        
                        <div class="ml-4">
                            <p class="text-lg font-semibold text-green-600">Si eres de Aguachica-Cesar , pagas cuando recibas !</p>
                            <p>Recibelo el mismo dia que se efectue la compra</p>
                        </div>
                    </div>
                </div>


                @if ($product->subcategory->size)
                    
                    @livewire('add-cart-item-size', ['product' => $product])

                @elseif($product->subcategory->color)

                    @livewire('add-cart-item-color', ['product' => $product])

                @else

                    @livewire('add-cart-item', ['product' => $product])

                @endif
            </div>
        </div>
        <div class="mx-1">
            <h2 class="font-bold text-lg">Descripción</h2>
            <hr>
                    {!!$product->description!!}
        </div>
    </div>

    @push('script')
        <script>
            $(document).ready(function() {
                $('.flexslider').flexslider({
                    animation: "slide",
                    controlNav: "thumbnails"
                });
            });

        </script>
    @endpush
</x-app-layout>
