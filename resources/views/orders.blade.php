<x-layout>

    <h1>{{ __('messages.order') }}</h1>
    <div class="container">
        <ul class="proditems">
            @foreach ($orders as $order) 
                <li>
                    
                        <div class="proditem">
                            <div class="prodimage">
                                {{ $order->user_name }}
                            </div>
                            <div class="proddetails">
                                <ul>
                                    <li>{{ __('messages.orders+details') }}: {{ $order->details }}</li>
                                    <li>{{ __('messages.order_price') }}: {{ $order->price }}</li>
                                    <li>{{ __('messages.order_date') }} : {{ $order->created_at->format('d/m/Y') }}</li>
                                </ul>
                            </div>
                            <div class="addbutton">
                                <a href="{{ route('order/',['id'=>$order->id]) }}" >{{ __('messages.view') }}</a>
                            </div>
                        </div>
                  
                </li>
           @endforeach
        </ul>

    </div>

</x-layout>