@extends('layouts.starlight')

@section('page_title')
    Category
@endsection

@section('category')
    active
@endsection

@section('content')
@include('layouts.nav')

<!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{ url('home') }}">Dashboard</a>
        <span class="breadcrumb-item active">Category</span>
      </nav>

      <div class="sl-pagebody">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            Category List
                        </div>

                        <div class="card-body">
                            <div class="alert alert-success text-center">
                                <h4>
                                    Total Category: {{ $total_categories }}
                                </h4>
                            </div>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Serial No</th>
                                        <th scope="col">Category Name</th>
                                        <th scope="col">Added By</th>
                                        <th scope="col">Created at</th>
                                        <th scope="col">Action</th>

                                    </tr>
                                </thead>

                                @foreach ($categories as $key => $category)
                                    <tbody>
                                        <tr>
                                            <th scope="row">{{ $categories ->firstItem() + $key }}</th>
                                            <td>{{ $category->category_name }}</td>
                                            <td>
                                                {{ App\Models\User::find($category->added_by)->name }}
                                                ({{ $category->added_by }})
                                                <br/>
                                                {{ App\Models\User::find($category->added_by)->email }}
                                            </td>
                                            <td>{{ $category->created_at }}</td>
                                            <td>
                                                <a href="{{ url('category/delete') }}/{{ $category->id }}" class="btn btn-danger btn-sm">Delete</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                @endforeach
                            </table>
                            {{ $categories->links() }}
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            Add Category
                        </div>

                        <div class="card-body">
                            @if (session('insertstatus'))
                                <div class="alert alert-success">
                                    {{ session('insertstatus') }}
                                </div>
                            @endif

                            <form action="{{ url('category/insert') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label>Category Name</label>
                                    <input type="text" class="form-control" name="category_name" id="category_name">
                                    @error('category_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>


                                <button type="submit" class="btn btn-primary">Add Category</button>
                            </form>
                        </div>
                    </div>
                    @if (session('deletestatus'))
                    <div class="alert alert-danger">
                        {{ session('deletestatus') }}
                    </div>
                    @endif
                </div>
            </div>
        </div>

        </div><!-- sl-pagebody -->
    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->



@endsection

