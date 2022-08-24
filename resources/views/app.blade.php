<html>

<head>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="style.css">
    <script type="text/javascript">

        $(document).ready(function() {

            function renderList(products, button, buttonMethod) {
                html = [
                    '<tr>',
                    '<th>{{ __('messages.product_title') }}</th>',
                    '<th>{{ __('messages.product_description') }}</th>',
                    '<th>{{ __('messages.product_price') }}</th>',
                    '</tr>'
                ].join('');

                $.each(products, function(key, product) {
                    html += [
                        '<tr>',
                        '<td>' + product.title + '</td>',
                        '<td>' + product.description + '</td>',
                        '<td>' + product.price + '</td>',
                        '<td> <a href="' + buttonMethod + product.id + '">' + button + ' </a> </td>',
                        '</tr>'
                    ].join('');
                });

                return html;
            }

            function renderListProducts(products, method1, method2) {
                html = [
                    '<tr>',
                    '<th>{{ __('messages.product_title') }}</th>',
                    '<th>{{ __('messages.product_description') }}</th>',
                    '<th>{{ __('messages.product_price') }}</th>',
                    '</tr>'
                ].join('');

                $.each(products, function(key, product) {
                    html += [
                        '<tr>',
                        '<td>' + product.title + '</td>',
                        '<td>' + product.description + '</td>',
                        '<td>' + product.price + '</td>',
                        '<td> <a href="' + method1 + product.id + '">{{ __('messages.edit') }} </a> </td>',
                        '<td> <a href="' + method2 + product.id +'">{{ __('messages.delete') }} </a> </td>',
                        '</tr>'
                    ].join('');
                });

                return html;
            }

            function renderListOrders(orders, method) {
                html = [
                    '<tr>',
                    '<th>{{ __('messages.order_client') }}</th>',
                    '<th>{{ __('messages.order_details') }}</th>',
                    '<th>{{ __('messages.order_price') }}</th>',
                    '<th>{{ __('messages.order_date') }}</th>',
                    '</tr>'
                ].join('');

                $.each(orders, function(key, order) {
                    html += [
                        '<tr>',
                        '<td>' + order.user_name + '</td>',
                        '<td>' + order.details + '</td>',
                        '<td>' + order.price + '</td>',
                        '<td>' + order.created_at + '</td>',
                        '<td> <a href="' + method + order.id + '" >{{ __('messages.view') }} </a> </td>',
                        '</tr>'
                    ].join('');
                });

                return html;
            }

            function renderListOrder(order, items) {
                html = [
                    '<div> {{ __('messages.order_client') }}  ' + order.user_name + 
                    '<br>',
                    '{{ __('messages.order_id') }} ' + order.id +
                    '</div>', 
                    '<tr>',
                    '<th>{{ __('messages.product_title') }}</th>',
                    '<th>{{ __('messages.product_description') }}</th>',
                    '<th>{{ __('messages.product_price') }}</th>',
                    '</tr>'
                ].join('');
                $.each(items, function(key, item) {
                    html += [
                        '<tr>',
                        '<td>' + item.title + '</td>',
                        '<td>' + item.description + '</td>',
                        '<td>' + item.price + '</td>',
                        '</tr>'
                    ].join('');
                });

                return html;
            }


            window.onhashchange = function() {

                $('.page').hide();

                switch (window.location.hash) {
                    case '#cart':

                        $('.cart').show();

                        $.ajax('/app-cart', {
                            dataType: 'json',
                            success: function(response) {
                                if (response.products.length === 0) {
                                    $('.cart .list').html('Empty cart');
                                    $('.cart .checkout-form').hide();
                                } else {
                                    $('.cart .list').html(renderList(response.products,
                                        '{{ __('messages.remove') }}', '/app-remove-cart/'
                                    ));
                                    $('.cart .checkout-form').html(response.html);

                                }

                            }   
                        });
                        break;

                    case '#login':
                        $('.login').show();

                        $.ajax('/app-login-form', {
                            type:'GET',
                            dataType: 'json',
                            success: function(response) {
                               
                                $('.login').html(response.html);
                            }
                        })

                        break;

                    case '#products':

                        $('.products').show();

                        $.ajax('/app-products', {
                            type: 'GET',
                            dataType: 'json',
                            success: function(response) {
                                $('.products .listProducts').html(renderListProducts(response
                                    .products,
                                    '#edit-product/', '/app-delete-product/'));
                            },
                            error: function(){
                                $('.products').html('{{ __('messages.forbidden') }}');
                            }, 
                        });
                        break;

                    case '#add-product':
                        $('.add-product').show();

                        
                        $.ajax('/app-add-form', {
                            type:'GET',
                            dataType: 'json',
                            success: function(response) {
                               
                                $('.add-product').html(response.html);
                            },
                            error: function(){
                                $('.add-product').html('{{ __('messages.forbidden') }}');
                            }, 
                        });
                        

                        break;
                    
                    case (window.location.hash.match(/^#edit-product\/\d+$/))?.input:
                        $('.edit-product').show();

                        var id= window.location.hash.substring(window.location.hash.lastIndexOf("/") + 1);
                        $.ajax('/app-edit-form/'+ id +'', {
                            type:'GET',
                            dataType: 'json',
                            success: function(response) {
                            
                                $('.edit-product').html(response.html);
                            },
                            error: function(){
                                $('.edit-product').html('{{ __('messages.forbidden') }}');
                            }, 
                        })

                        break;

                    case '#orders':

                        $('.orders').show();

                        $.ajax('/app-orders', {
                            type: 'GET',
                            dataType: 'json',
                            success: function(response) {
                                $('.orders .listOrders').html(renderListOrders(response
                                    .orders,
                                    '#order/'));
                            },
                             error: function(){
                                $('.orders').html('{{ __('messages.forbidden') }}');
                            }, 
                        });
                        break;

                    case (window.location.hash.match(/^#order\/\d+$/))?.input:

                        $('.order').show();

                        var id= window.location.hash.substring(window.location.hash.lastIndexOf("/") + 1);
                  
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        $.ajax('/app-orderItems/' + id + '', {
                            dataType: 'json',
                            success: function(response) {
                               
                                $('.order .listOrder').html(renderListOrder(response
                                    .order, response.orderItems));
                            },
                            error: function(){
                                $('.order').html('{{ __('messages.forbidden') }}');
                            }, 
                        });

                        break;

                    default:

                        $('.index').show();

                        $.ajax('/app-index', {
                            type: 'GET',
                            dataType: 'json',
                            success: function(response) {

                                $('.index .list').html(renderList(response.products,
                                    '{{ __('messages.add') }}', '/app-add-cart/'));
                            }
                        });
                        break;
                }
            }

            window.onhashchange();
        });
    </script>
</head>

<body>

    <div class="page index">

        <table class="list"></table>


        <a href="#cart" class="button">Go to cart</a>
        <br>
        <a href="#login" class="button"> Login</a>
        <br>
        <a href="#products" class="button"> Go to products</a>
        <br>
        <a href="#orders" class="button"> Go to orders</a>
    </div>


    <div class="page cart">

        <table class="list"></table>

        <div class="checkout-form">
        </div>
    </div>
    <div class="page login">
       
    </div>
    <div class="page products">

        <table class="listProducts"></table>


        <a href="#" class="button">Go to index</a>
        <br>
        <a href="#add-product" class="button">Add product</a>
    </div>
    <div class="page add-product">
      
    </div>

    </div>
    <div class="page edit-product">
   
    </div>

    <div class="page orders">

        <table class="listOrders"></table>
        <a href="#" class="button"> Go to index</a>
    </div>

    <div class="page order">
        <table class="listOrder"></table>

        <a href="#orders" class="button"> Go to orders</a>
    </div>
    @if (session()->has('succes'))
        <div>
            <p class="confirm">{{ session()->get('succes') }}</p>
        </div>
    @endif
</body>

</html>
