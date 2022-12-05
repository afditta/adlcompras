<div>

    @php
        
        // SDK de Mercado Pago
        require base_path('vendor/autoload.php');
        // Agrega credenciales
        MercadoPago\SDK::setAccessToken(config('services.mercadopago.token'));
        // payment_methods
    
        
        // Crea un objeto de preferencia
        $preference = new MercadoPago\Preference();
    
        $shipments = new MercadoPago\Shipments();
        // aqui poner cuando ya este en produccion $order->shipping_cost
        $shipments->cost=$order->shipping_cost;
        $shipments->mode="not_specified";
        $preference->shipments= $shipments;
        // Crea un ítem en la preferencia
        foreach ($items as $product) {
            # code...
    
            $item = new MercadoPago\Item();
            $item->title =  $product->name;
            $item->quantity =  $product->qty;
            // aqui poner datos enteros de los productos
            $item->unit_price = $product->price;
            $products[]= $item;
    
        }
    
            
        $preference->back_urls = array(
            "success" => route('orders.pay',$order),
            
            "failure" => "http://adlcompras.test/",
            "pending" => "http://adlcompras.test/"
        );
        $preference->auto_return = "approved";
    
    
        $preference->items =    $products;
        $preference->save();
    
       
    @endphp
        
        <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-5 gap-6 container py-8">

            <div class="order-2 lg:order-1 xl:col-span-3">
                <div class="bg-white rounded-lg shadow-lg px-6 py-4 mb-6">
                    <p class="text-gray-700 uppercase"><span class="font-semibold">Número de orden:</span>
                        Orden-{{ $order->id }}</p>
                </div>
    
                <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                    <div class="grid grid-cols-2 gap-6 text-gray-700">
                        <div>
                            <p class="text-lg font-semibold uppercase">Envío</p>
    
                            @if ($order->envio_type == 1)
                                <p class="text-sm">Los productos deben ser recogidos en tienda</p>
                                <p class="text-sm">Calle 5 #24</p>
                            @else
                                <p class="text-sm">Los productos Serán enviados a:</p>
                                <p class="text-sm">{{ $envio->address }}</p>
                                <p>{{ $envio->department }} - {{ $envio->city }} 
                                </p>
                            @endif
    
    
                        </div>
    
                        <div>
                            <p class="text-lg font-semibold uppercase">Datos de contacto</p>
    
                            <p class="text-sm">Persona que recibirá el producto: {{ $order->contact }}</p>
                            <p class="text-sm">Teléfono de contacto: {{ $order->phone }}</p>
                        </div>
                    </div>
                </div>
    
                <div class="bg-white rounded-lg shadow-lg p-6 text-gray-700 mb-6">
                    <p class="text-xl font-semibold mb-4">Resumen</p>
    
                    <table class="table-auto w-full">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Precio</th>
                                <th>Cant</th>
                                <th>Total</th>
                            </tr>
                        </thead>
    
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($items as $item)
                                <tr>
                                    <td>
                                        <div class="flex">
                                            <img class="h-15 w-20 object-cover mr-4" src="{{ $item->options->image }}"
                                                alt="">
                                            <article>
                                                <h1 class="font-bold">{{ $item->name }}</h1>
                                                <div class="flex text-xs">
    
                                                    @isset($item->options->color)
                                                        Color: {{ __($item->options->color) }}
                                                    @endisset
    
                                                    @isset($item->options->size)
                                                        - {{ $item->options->size }}
                                                    @endisset
                                                </div>
                                            </article>
                                        </div>
                                    </td>
    
                                    <td class="text-center">
                                      $ {{ number_format($item->price )}} 
                                    </td>
    
                                    <td class="text-center">
                                        {{ $item->qty }}
                                    </td>
    
                                    <td class="text-center">
                                      $  {{number_format( $item->price * $item->qty )}} 
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
    
    
    
            </div>
    
            <div class="order-1 lg:order-2 xl:col-span-2">
                
                <div class="bg-white rounded-lg shadow-lg px-6 pt-6 ">
                    <h1 class="text-center text-lg font-semibold uppercase">Metodos de pago</h1>
                    <div class="flex justify-between items-center mb-4">
                        <img class="h-12 items-center" src="{{ asset('img/mer.png') }}" alt="">
                        <div class="text-gray-700">
                            <p class="text-sm font-semibold">
                                Subtotal: ${{ number_format($order->total - $order->shipping_cost )}} 
                            </p>
                            <p class="text-sm font-semibold">
                                Envío: $ {{number_format( $order->shipping_cost )}} 
                            </p>
                            <p class="text-lg font-semibold uppercase">
                                Total: $ {{ number_format($order->total )}} 
                            </p>
                            
                            <div class="cho-container">
    
                            </div>
                            
                            <br>
                        </div>
                    </div>
                    
    
    
                    {{-- <div id="paypal-button-container"></div> --}}
    
                </div>
                @if($order->envio_type == 2 && $envio->city=="aguachica")
                    <div class="bg-white rounded-lg shadow-lg px-6 pt-6">
                        <div class="flex justify-between items-center mb-4">
                            <img class=" h-12 items-center" src="{{ asset('img/rec.png') }}" alt="">
                            <div class="text-gray-700">
                                <x-button-enlace  class="ml-auto bg-blue-500" href="{{ route('orders.recibed',$order)}}">
                                    Pagar al recibir
                                </x-button-enlace>
                            </div>
                            
                            
                        </div>
                        <div class="mb-12 ">
                            <hr class="mt-10">
                            <p class="text-sm text-center font-semibold">
                                Una vez se haga click en "Pagar al recibir " la compra empezara su proceso de entrega.
                            </p>
                        </div>
                
                    </div>
                @elseif($order->envio_type == 2 && $envio->city=="gamarra")
                <div class="bg-white rounded-lg shadow-lg px-6 pt-6">
                    <div class="flex justify-between items-center mb-4">
                        <img class=" h-12 items-center" src="{{ asset('img/rec.png') }}" alt="">
                        <div class="text-gray-700">
                            <x-button-enlace  class="ml-auto bg-blue-500" href="{{ route('orders.recibed',$order)}}">
                                Pagar al recibir
                            </x-button-enlace>
                        </div>
                        
                        
                    </div>
                    <div class="mb-12 ">
                        <hr class="mt-10">
                        <p class="text-sm text-center font-semibold">
                            Nota
                        </p>
                    </div>
            
                </div>
                @endif
            </div>
            
        </div>
            {{-- // SDK MercadoPago.js V2 --}}
           
        @push('script')
        <script src="https://sdk.mercadopago.com/js/v2"></script>
            <script>
            
                const mp = new MercadoPago("{{config('services.mercadopago.key')}}", {
    
                    locale: 'es-CO'
    
                });
    
                mp.checkout({
    
                    preference: {
    
                        id: '{{ $preference->id }}'
    
                    },
    
                    render: {
    
                        container: '.cho-container',
    
                        label: 'Pagar',
    
                    }
    
            });
    
        </script>
        @endpush
    
      
    </div>