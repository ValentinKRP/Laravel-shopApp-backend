<x-layout>
  
  <div class="container">
    <h1>{{ __('messages.add_product') }}</h1>
    <form action="/product-add" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">{{ __('messages.product_name') }}</label>   
            <input type="text" name="title"  value="{{ old('title') }}" required>
            @error('title')
            <p class="error">{{ $message }}</p>
            @enderror
        </div>
    
      <div class="form-group">
        <label for="description">{{ __('messages.product_description') }}</label>   
        <input type="text" name="description" value="{{ old('description') }}" required>
        @error('description')
        <p class="error">{{ $message }}</p>
    @enderror
    </div>
      
      
       <div class="form-group">
        <label for="price">{{ __('messages.product_price') }}</label>   
        <input type="number" name="price" value="{{ old('Price') }}" required>
        @error('price')
        <p class="error">{{ $message }}</p>
    @enderror
    </div>
      
       <div class="form-group">
        <label for="image">{{ __('messages.product_image') }}</label>   
        <input type="file" name="image" required>
        @error('image')
        <p class="error">{{ $message }}</p>
    @enderror
        </div>
    
       <button type="submit">{{ __('messages.add') }}</button>
    </div>
   </form>
  </div>

</x-layout>