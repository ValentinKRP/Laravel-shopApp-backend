<x-layout>

    <h1>{{ __('messages.product') }}</h1>

    <div class="container">
        <ul class="proditems">
            @foreach ($products as $product) 
                <li>
                    
                        <div class="proditem">
                            <div class="prodimage">
                                <img src="{{ asset('storage/' . $product->image) }}">
                            </div>
                            <div class="proddetails">
                                <ul>
                                    <li>{{ __('messages.product_title') }}: {{ $product->title }}</li>
                                    <li>{{ __('messages.product_description') }}: {{ $product->description }}</li>
                                    <li>{{ __('messages.product_price') }} :{{ $product->price }}</li>
                                </ul>
                            </div>
                            <div class="addbutton">
                                <a href="product-edit/{{ $product->id }}"  >{{ __('messages.edit') }}</a>
                               
                            </div> 
                            <div class="addbutton">
                               <form action="/product/{{ $product->id }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button>{{ __('messages.delete') }}</button>
                            </form>
                      
                            </div>
                        </div>
                  
                </li>
           @endforeach
        </ul>
        <div>
        
            <a href="{{ route('addProductForm') }}">{{ __('messages.add') }}</a>
        </div>
    <div>

       <form action="/logout" method="POST">
        @csrf
        <button type="submit">{{ __('messages.logout') }}</button>
        
    </form>
        
    </div>
  
    </div>
</x-layout>