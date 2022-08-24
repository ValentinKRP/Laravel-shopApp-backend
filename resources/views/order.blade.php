<x-layout>

    <div class="container">
        <h3>{{ __('messages.order_id') }}: {{ $order->id }}</h3>
        <h3>{{ __('messages.order_client') }}: {{ $order->user_name }}</h3>
        <ul class="proditems">
            @foreach ($orderProducts as $product) 
                <li>
                    
                        <div class="proditem">
                            <div class="prodimage">
                                <img src="uploads/{{ $product->image }}">
                            </div>
                            <div class="proddetails">
                                <ul>
                                    <li>{{ __('messages.product_title') }}: {{ $product->title }}</li>
                                    <li>{{ __('messages.product_description') }}: {{ $product->description }}</li>
                                    <li>{{ __('messages.product_price') }} :{{ $product->price }}</li>
                                </ul>
                            </div>
            
                        </div>
                  
                </li>
           @endforeach
        </ul>

    </div>
</x-layout>