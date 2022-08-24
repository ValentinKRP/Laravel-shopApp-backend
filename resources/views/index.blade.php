<x-layout>

    <h1>{{ __('messages.title') }}</h1>

    <div class="container">
        <ul class="proditems">
            @foreach ($products as $product) 
                <li>
                    
                        <div class="proditem">
                            <div class="prodimage">
                                <img src="{{ asset($product->image)}}">
                            </div>
                            <div class="proddetails">
                                <ul>
                                    <li>{{ __('messages.product_title') }}: {{ $product->title }}</li>
                                    <li>{{ __('messages.product_description') }}: {{ $product->description }}</li>
                                    <li>{{ __('messages.product_price') }} : {{ $product->price }}</li>
                                </ul>
                            </div>
                            <div class="addbutton">
                                <a href="{{ route('addToCart',['id' => $product->id])  }}"  name="add">{{ __('messages.add') }}</a>
                            </div>
                        </div>
                  
                </li>
           @endforeach
        </ul>
        <a href="{{ route('cart') }}">{{ __('messages.cart') }}</a>
    </div>

</x-layout>