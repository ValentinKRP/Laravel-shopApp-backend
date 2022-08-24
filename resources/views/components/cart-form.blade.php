<div class="inputs">
    <form action="{{ route('checkoutApp') }}" method="POST">
        @csrf

        <label for="name">{{ __('messages.order_client') }}</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}" required>
        @error('name')
            <p class="error"> {{ $message }}</p>
        @enderror
        <br>
        <label for="details">{{ __('messages.order_details') }}</label>
        <input type="text" id="details" size="50" name="details" value="{{ old('details') }}"
            required>
        @error('details')
            <p class="error"> {{ $message }}</p>
        @enderror
        <br>
        <label for="comments">{{ __('messages.order_comments') }}</label>
        <input type="text" id="comments" size="50" name="comments" value="{{ old('comments') }}"
            required>
        @error('comments')
            <p class="error""> {{ $message }}</p>
        @enderror
        <br>

        <button type="submit" name="checkout">{{ __('messages.checkout') }}</button>
    </form>
</div>
</div>
<a href="#" class="button">{{ __('messages.index') }}</a>