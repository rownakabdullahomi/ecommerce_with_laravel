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
        <a class="breadcrumb-item" href="{{ url('subcategory') }}">Sub Category</a>
        <span class="breadcrumb-item active">{{ $subcategory_info->sub_category_name }}</span>
      </nav>

      <div class="sl-pagebody">

            <div class="container">
                <div class="row">
                    <div class="col-md-6 m-auto">
                        <div class="card">
                            <div class="card-header">
                                Edit Sub-Category
                                {{-- {{ $subcategory_info }} --}}
                            </div>


                            <div class="card-body">
                                @if (session('subcategoryupdate'))
                                    <div class="alert alert-success">
                                        {{ session('subcategoryupdate') }}
                                    </div>
                                @endif

                                <form action="{{ url('subcategory/update') }}/{{ $subcategory_info->id }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label>Category Name</label>
                                        <input type="hidden" value="{{ $subcategory_info->id }}" name="sub_category_id">
                                        <select name="category_id" class="form-control">
                                            <option value="">Select One</option>
                                            @foreach ($categories as $category)
                                                <option {{ ($subcategory_info->category_id == $category->id)? "selected" : "" }} value="{{ $category->id }}">{{ $category->id }} => {{ $category->category_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Sub-Category Name</label>
                                        <input type="text" class="form-control" name="sub_category_name" value="{{ $subcategory_info->sub_category_name }}">
                                        @error('sub_category_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    @if (session('errorstatus'))
                                        <div class="alert alert-danger">
                                            {{ session('errorstatus') }}
                                        </div>
                                    @endif
                                    <button type="submit" class="btn btn-warning">Edit Sub-Category</button>
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

