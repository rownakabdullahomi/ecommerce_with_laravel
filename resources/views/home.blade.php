@extends('layouts.starlight')

@section('page_title')
    Dashboard
@endsection

@section('dashboard')
    active
@endsection

@section('content')
@include('layouts.nav')





<!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <span class="breadcrumb-item active">Dashboard</span>
      </nav>

      <div class="sl-pagebody">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                Dashboard
                            </div>

                            <div class="card-body">
                                {{-- @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif --}}

                                {{-- <p>
                                Welcome {{ Auth::user()->name }}
                                </p>
                                You are logged in !
                                <p>
                                Enmail: {{ Auth::user()->email }}
                                </p>
                                <p>
                                ID: {{ Auth::id() }}
                                </p> --}}





                                <div class="alert alert-success text-center">
                                    <h1>
                                        Total user: {{ $total_users }}
                                    </h1>
                                </div>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">Serial No</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">User ID</th>
                                            <th scope="col">Created at</th>
                                        </tr>
                                    </thead>

                                    @foreach ($users as $user)
                                        <tbody>
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->id }}</td>
                                                <td>
                                                    @if ($user->created_at->diffInDays(Carbon\Carbon::today()) > 30)
                                                        {{ $user->created_at->format('d/m/Y h:i:s A') }}
                                                    @else
                                                        {{ $user->created_at->format('d/m/Y h:i:s A') }}
                                                        <br/>
                                                        <span class="badge badge-success">
                                                            {{ $user->created_at->diffForHumans() }}
                                                        </span>
                                                    @endif
                                                    {{-- <p>Today: {{ Carbon\Carbon::today() }}</p>
                                                    <p>Difference in days: {{ $user->created_at->diffInDays(Carbon\Carbon::today()) }}</p>
                                                    {{ $user->created_at->format('d/m/Y h:i:s A') }}
                                                    <br/>
                                                    <span class="badge badge-success">
                                                        {{ $user->created_at->diffForHumans() }}
                                                    </span> --}}
                                                </td>
                                            </tr>
                                        </tbody>
                                    @endforeach
                                </table>
                                {{ $users->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- sl-pagebody -->
    </div><!-- sl-mainpanel -->

    <!-- ########## END: MAIN PANEL ########## -->



@endsection
