<x-layout>
  
    <div class="container">
        <h1>{{ __('messages.edit') }}{{ $product->title }}</h1>
      <form action="/product/{{ $product->id }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PATCH')
          <div class="form-group">
              <label for="title">{{ __('messages.product_name') }}</label>   
              <input type="text" name="title"  value="{{ old('title', $product->title ) }}"  required>
              @error('title')
              <p class="error">{{ $message }}</p>
              @enderror
          </div>
      
        <div class="form-group">
          <label for="description">{{ __('messages.product_description') }}</label>   
          <input type="text" name="description" value="{{ old('description', $product->description )}}" required>
          @error('description')
          <p class="error">{{ $message }}</p>
      @enderror
      </div>
        
        
         <div class="form-group">
          <label for="price">{{ __('messages.product_price') }}</label>   
          <input type="number" name="price" value="{{ old('price', $product->price) }}" required>
          @error('price')
          <p class="error">{{ $message }}</p>
      @enderror
      </div>
        
         <div class="form-group">
        <label for="image">{{ __('messages.product_image') }}</label>   
          <input type="file" name="image" >
          <img src="{{ asset('storage/' . $product->image) }}">
          @error('image')
          <p class="error">{{ $message }}</p>
      @enderror
          </div>
      
         <button type="submit">{{ __('messages.edit') }}</button>
      </div>
     </form>
     <a href="{{ route('products') }}">{{ __('messages.index') }}</a>
    </div>

  </x-layout>