@extends('layouts.starlight')

@section('page_title')
    Edit Profile
@endsection

@section('content')
@include('layouts.nav')

<!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{ url('home') }}">Dashboard</a>
        <span class="breadcrumb-item active">Edit Profile</span>
      </nav>

      <div class="sl-pagebody">
        <div class="container">
            <div class="row">

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            Change Name
                        </div>

                        <div class="card-body">
                            @if (session('insertstatus'))
                                <div class="alert alert-success">
                                    {{ session('insertstatus') }}
                                </div>
                            @endif

                            <form action="{{ url('editporfile/name/change') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="name" id="name" value="{{ Auth::user()->name }}">
                                    @error('category_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>


                                <button type="submit" class="btn btn-info">Chane Name</button>
                            </form>
                        </div>
                    </div>
                    @if (session('updatestatus'))
                    <div class="alert alert-success">
                        {{ session('updatestatus') }}
                    </div>
                    @endif
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            Change Password
                        </div>

                        <div class="card-body">
                            @if (session('insertstatus'))
                                <div class="alert alert-success">
                                    {{ session('insertstatus') }}
                                </div>
                            @endif

                            @if (session('oldpassworderror'))
                                <div class="alert alert-danger">
                                    {{ session('oldpassworderror') }}
                                </div>
                            @endif

                            @if (session('passwordweak'))
                                <div class="alert alert-warning">
                                    {{ session('passwordweak') }}
                                </div>
                            @endif

                            <form action="{{ url('editporfile/password/change') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label>Old Password</label>
                                    <input type="password" class="form-control" name="old_password">
                                     @error('old_password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>New Password</label>
                                    <input type="password" class="form-control" name="password">
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input type="password" class="form-control" name="password_confirmation">
                                    @error('password_confirmation')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>


                                <button type="submit" class="btn btn-warning">Change Password</button>
                            </form>
                        </div>
                    </div>
                    @if (session('updatestatus'))
                    <div class="alert alert-success">
                        {{ session('updatestatus') }}
                    </div>
                    @endif

                    @if (session('passwordupdate'))
                    <div class="alert alert-success">
                        {{ session('passwordupdate') }}
                    </div>
                    @endif
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            Change Profile Photo
                        </div>

                        <div class="card-body">
                            @if (session('insertstatus'))
                                <div class="alert alert-success">
                                    {{ session('insertstatus') }}
                                </div>
                            @endif

                            @if (session('oldpassworderror'))
                                <div class="alert alert-danger">
                                    {{ session('oldpassworderror') }}
                                </div>
                            @endif

                            @if (session('passwordweak'))
                                <div class="alert alert-warning">
                                    {{ session('passwordweak') }}
                                </div>
                            @endif

                            <form action="{{ url('editporfile/photo/change') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group text-center">
                                    <label>Current Profile Photo</label>
                                    <br>
                                    <img class="w-25 border" src="{{ asset('uploads/profile_photos') }}/{{ Auth::user()->profile_photo }}" alt="">
                                </div>
                                <div class="form-group">
                                    <label>New Profile Photo </label>
                                    <input type="file" class="form-control-file" name="new_profile_photo">
                                     @error('new_profile_photo')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-secondary">Change Photo</button>
                            </form>
                            @if (session('photouploadstatus'))
                                <div class="alert alert-success">
                                    {{ session('photouploadstatus') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        </div><!-- sl-pagebody -->
    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->

@endsection
