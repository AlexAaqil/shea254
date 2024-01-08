@extends('partials.base')

@section('content')
<main class="Admin">
    @include('admin.sidenav')
    <section class="Main Admins">
        <div class="container">
            <div class="header"> 
                <h1> Update Admin</h1>
            </div>

            <div class="body">
                <form action="" method="post">
                    @csrf
                    <div class="input_group">
                        <label for="First_name">Frist Name</label>
                        <input type="text" name="first_name" id="first_name" value="{{ old('first_name' ,$admin->first_name) }}" readonly >
                    </div>
                    <div class="input_group">
                        <label for="last_name">Last Name</label>
                        <input type="text" name="last_name" id="last_name" value="{{ old('last_name' ,$admin->last_name) }}" readonly >
                    </div>
                    <div class="input_group">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" value="{{ old('email' ,$admin->email) }}" readonly >
                        <span class="inline_alert">{{ $errors->first('email') }}</span>
                    </div>
                    <div class="input_group">
                        <label for="phone_number">Phone number</label>
                        <input type="text" name="phone_number" id="phone_number" value="{{ old('phone_number' ,$admin->phone_number) }}" readonly >
                    </div>
            
                    <div class="row_input_group">
                        <div class="input_group">
                            <label for="status">Status</label>
                            <div class="custom_radio_buttons">
                                <label>
                                    <input class="option_radio" type="radio" name="status" id="status" value="1" {{ ($admin->status == 1) ? 'checked' : '' }}>
                                    <span>Active</span>
                                </label>

                                <label>
                                    <input class="option_radio" type="radio" name="status" id="status" value="0" {{ ($admin->status == 0) ? 'checked' : '' }}>
                                    <span>Inactive</span>
                                </label>
                            </div>
                        </div>

                        <div class="input_group">
                            <label for="status">User Level</label>
                            <div class="custom_radio_buttons">
                                <label>
                                    <input class="option_radio" type="radio" name="user_level" id="user_level" value="1" {{ ($admin->is_admin == 1) ? 'checked' : '' }}>
                                    <span>Admin</span>
                                </label>

                                <label>
                                    <input class="option_radio" type="radio" name="user_level" id="user_level" value="0" {{ ($admin->is_admin == 0) ? 'checked' : '' }}>
                                    <span>User</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <button type="submit">Update</button>
                </form>
              
            </div>
        </div>
    </section>
</main>
@include('partials.javascripts')
@endsection