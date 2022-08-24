<html lang="en">


<body>
    <div>
        <div>
           <p>{{ $order->user_name }}</p>
        </div>
  
        @foreach ($orderItems as $product )
         <div class="proditem">
            <div class="prodimage">
                 <img style="width:50px; height:50px;" src="{{ $message->embed(public_path().'/'.$product->image) }}">
            </div>
            <div class="proddetails">
                    <ul>
                          <li>{{ __('messages.prodcut_title') }}: {{  $product->title }}</li>
                         <li>{{ __('messages.product_description') }}:{{  $product->description }}</li>
                            <li>{{ __('messages.product_price') }}: {{  $product->price }} </li>
                    </ul>
             </div>
                 @endforeach
        </div>
         <div class="order_details">
            <p>{{ __('messages.order_details') }}: {{ $order->details }} </p><br><br>
            <p>{{ __('messages.order_price') }}: {{ $order->price }} </p><br><br>
            <p>{{ __('messages.order_date') }}: {{ $order->created_at }} </p><br><br>
         </div>
    
    </div>
</body>

</html>