<div id="box">
    <div>{{ __('messages.login') }}</div>
    <form method="POST" action="/loginApp">
        @csrf
        <label for="user_name">{{ __('messages.user_name') }}</label>
        <input type="text" name="user_name" value="{{ old('user_name') }}" required>
        @error('user_name')
            <p class="error">{{ $message }}</p>
        @enderror
        <label for="password">{{ __('messages.password') }}</label>
        <input type="password" name="password"  required>
        @error('password')
        <p class="error">{{ $message }}</p>
        @enderror
        <button type="submit"> {{ __('messages.login') }} </button>
    </form>
    <a href="#" class="button">Go to index</a>
</div>