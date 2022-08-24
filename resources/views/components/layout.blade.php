
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="/style.css" rel="stylesheet" >
        <title>Training</title>

     
    </head>
    <body >
         {{ $slot }}
        @if(session()->has('succes'))
         <div>
            <p class="confirm">{{ session()->get('succes') }}</p>
         </div>
         @endif
    </body>
</html>
