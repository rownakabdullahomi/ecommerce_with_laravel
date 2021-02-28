@extends('layouts.starlight')

@section('page_title')
    Sub-Category
@endsection

@section('subcategory')
    active
@endsection

@section('content')
@include('layouts.nav')

<!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{ url('home') }}">Dashboard</a>
        <a class="breadcrumb-item" href="{{ url('category') }}">Category</a>
        <span class="breadcrumb-item active">Subcategory</span>
      </nav>

      <div class="sl-pagebody">

            <div class="container">
                <div class="row">
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header">
                                Sub-Category List
                            </div>

                            <div class="card-body">
                                <div class="alert alert-success text-center">
                                    <h4>
                                        Total Sub-categories: {{ $total_sub_categories }}
                                    </h4>
                                </div>
                                <form method="POST" action="{{ url('subcategory/mark/delete') }}">
                                 @csrf
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Mark</th>
                                            <th scope="col">Serial No</th>
                                            <th scope="col">Sub-Category Name</th>
                                            <th scope="col">Category Name</th>
                                            <th scope="col">Created at</th>
                                            <th scope="col">Action</th>

                                        </tr>
                                    </thead>

                                        <tbody>
                                            @forelse ($subcategories as $key => $subcategory)
                                            <tr>
                                                <th>
                                                    <input type="checkbox" value="{{ $subcategory->id }}" name="mark_delete_id[]">
                                                </th>
                                                <th scope="row">{{ $subcategories->firstItem() + $key }}</th>
                                                <td>{{ $subcategory->sub_category_name }}</td>
                                                <td>
                                                    {{ App\Models\Category::find($subcategory->category_id)->category_name }}
                                                    {{-- ({{ $category->added_by }}) --}}
                                                    <br/>
                                                    {{-- {{ App\Models\User::find($category->added_by)->email }} --}}
                                                </td>
                                                <td>{{ $subcategory->created_at }}</td>
                                                <td>
                                                    <a href="{{ url('subcategory/delete') }}/{{ $subcategory->id }}" class="btn btn-danger btn-sm">Delete</a>
                                                    <a href="{{ url('subcategory/edit') }}/{{ $subcategory->id }}" class="btn btn-warning btn-sm">Edit</a>
                                                </td>
                                            </tr>
                                            @empty
                                                <tr class="text-center ">
                                                    <td colspan="50" class="text-danger">No data to show.</td>
                                                </tr>

                                            @endforelse
                                        </tbody>
                                </table>

                                <button type="submit" class="btn btn-sm btn-danger" style="float: right; margin-left:5px">Mark Delete</button>
                                <a href="{{ url('subcategory/all/delete') }}" class="btn btn-sm btn-danger" style="float: right">All Delete</a>
                                @if (session('markdeleteerror'))
                                    <div class="alert alert-warning" style="width: 50%">
                                        {{ session('markdeleteerror') }}
                                    </div>
                                @endif

                                @if (session('alldelete'))
                                    <div class="alert alert-danger" style="width: 50%">
                                        {{ session('alldelete') }}
                                    </div>
                                @endif


                            </form>
                                {{-- {{ $subcategories->links() }} --}}
                                {{ $subcategories->appends(['deleted_subcategories' => $deleted_subcategories->currentPage()])-> links() }}
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                Sub-Category Restore List
                            </div>

                            <div class="card-body">
                                {{-- <div class="alert alert-success text-center">
                                    <h1>
                                        Total Sub-categories: {{ $total_sub_categories }}
                                    </h1>
                                </div> --}}
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">Serial No</th>
                                            <th scope="col">Sub-Category Name</th>
                                            <th scope="col">Category Name</th>
                                            <th scope="col">Created at</th>
                                            <th scope="col">Action</th>

                                        </tr>
                                    </thead>

                                        <tbody>
                                            @forelse ($deleted_subcategories as $key => $deleted_subcategory)
                                            <tr>
                                                <th scope="row">{{ $loop->index + 1 }}</th>
                                                <td>{{ $deleted_subcategory->sub_category_name }}</td>
                                                <td>
                                                    {{ App\Models\Category::find($deleted_subcategory->category_id)->category_name }}
                                                    {{-- ({{ $category->added_by }}) --}}
                                                    <br/>
                                                    {{-- {{ App\Models\User::find($category->added_by)->email }} --}}
                                                </td>
                                                <td>{{ $deleted_subcategory->created_at }}</td>
                                                <td>
                                                    <a href="{{ url('subcategory/restore') }}/{{ $deleted_subcategory->id }}" class="btn btn-success btn-sm">Restore</a>
                                                    <a href="{{ url('subcategory/permanent/delete') }}/{{ $deleted_subcategory->id }}" class="btn btn-danger btn-sm">P.Delete</a>
                                                </td>
                                            </tr>
                                            @empty
                                                <tr class="text-center ">
                                                    <td colspan="50" class="text-danger">No data to show.</td>
                                                </tr>

                                            @endforelse



                                        </tbody>

                                </table>
                                {{-- {{ $deleted_subcategories->links() }} --}}
                                {{ $deleted_subcategories->appends(['subcategories' => $subcategories->currentPage()])-> links() }}
                            </div>
                        </div>

                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-header">
                                Add Sub-Category
                            </div>


                            <div class="card-body">
                                @if (session('insertstatus'))
                                    <div class="alert alert-success">
                                        {{ session('insertstatus') }}
                                    </div>
                                @endif

                                <form action="{{ url('subcategory/insert') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label>Category Name</label>
                                        <select name="category_id" class="form-control">
                                            <option value="">Select One</option>
                                            @foreach ($categories as $category)
                                                <option {{ (old('category_id') == $category->id)? "selected" : "" }} value="{{ $category->id }}">{{ $category->id }} => {{ $category->category_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Sub-Category Name</label>
                                        <input type="text" class="form-control" name="sub_category_name" value="{{ old('sub_category_name') }}">
                                        @error('sub_category_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    @if (session('errorstatus'))
                                        <div class="alert alert-danger">
                                            {{ session('errorstatus') }}
                                        </div>
                                    @endif
                                    <button type="submit" class="btn btn-primary">Add Sub-Category</button>
                                </form>
                            </div>
                        </div>
                        @if (session('deletestatus'))
                            <div class="alert alert-danger">
                                {{ session('deletestatus') }}
                            </div>
                        @endif

                        @if (session('restorestatus'))
                            <div class="alert alert-success">
                                {{ session('restorestatus') }}
                            </div>
                        @endif

                        @if (session('p.deletestatus'))
                            <div class="alert alert-danger">
                                {{ session('p.deletestatus') }}
                            </div>
                        @endif

                        @if (session('markdeletestatus'))
                            <div class="alert alert-danger">
                                {{ session('markdeletestatus') }}
                            </div>
                        @endif

                    </div>
                </div>
            </div>

      </div><!-- sl-pagebody -->
    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->


@endsection

