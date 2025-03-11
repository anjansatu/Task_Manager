@extends('user.layouts.master')

@section('title', 'Order')

@section('user-content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Order</h1>
                <form action="{{ route('orders.store') }}" method="post">
                    @csrf
                    <div class="form-group
                        @error('name')
                            has-error
                        @enderror">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
                        @error('name')
                            <span class="help-block
                                @error('name')
                                    has-error
                                @enderror">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group
                        @error('email')
                            has-error
                        @enderror">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
                        @error('email')
                            <span class="help-block
                                @error('email')
                                    has-error
                                @enderror">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group
                        @error('phone')
                            has-error
                        @enderror">
                        <label for="phone">Phone</label>
                        <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone') }}">
                        @error('phone')
                            <span class="help-block has-error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group  @error('address') has-error @enderror">
                        <label for="address">Address</label>
                        <textarea name="address" id="address" class="form-control">{{ old('address') }}</textarea>
                        @error('address')
                            <span class="help-block
                                @error('address')
                                    has-error
                                @enderror">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group
                        @error('note')
                            has-error
                        @enderror">
                        <label for="note">Note</label>
                        <textarea name="note" id="note" class="form-control">{{ old('note') }}</textarea>
                        @error('note')
                            <span class="help-block
                                @error('note')
                                    has-error
                                @enderror">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Order</button>
                </form>
            </div>
        </div>
    </div>
@endsection
```

