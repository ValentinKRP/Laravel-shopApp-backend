<x-layout>

    <h1>{{ __('messages.cart_title') }}</h1>

  <div class="container">
    @if (session('cart'))
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
                                <li>{{ __('messages.product_price') }} :{{ $product->price }}</li>
                            </ul>
                        </div>
                        <div class="addbutton">
                            <a href="{{ route('removeFromCart',['id' => $product->id])  }}"  >{{ __('messages.remove') }}</a>
                            
                        </div>
                    </div>
              
            </li>
       @endforeach
    </ul>
    <div class="inputs">
        <form action="{{ route('checkout') }}" method="POST">
        @csrf

        <label for="name">{{ __('messages.order_client') }}</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}" required>
        @error('name')
            <p class="error"> {{ $message }}</p>
        @enderror
        <br>
        <label for="details">{{ __('messages.order_details') }}</label>
        <input type="text" id="details" size="50" name="details" value="{{ old('details') }}" required>
        @error('details')
        <p class="error"> {{ $message }}</p>
    @enderror
        <br>
        <label for="comments">{{ __('messages.order_comments') }}</label>
        <input type="text" id="comments" size="50" name="comments" value="{{ old('comments') }}" required>
        @error('comments')
        <p class="error""> {{ $message }}</p>
    @enderror
        <br>
        <input type="hidden" name="price" value="{{ $total }}">
        <button type="submit" name="checkout">{{ __('messages.checkout') }}</button>
        </form>  
    </div>
    @else
    <span>{{  __('messages.empty_cart') }}</span>
    @endif
    <a href="{{ route('index') }}">{{ __('messages.index') }}</a>
</div>


</x-layout>