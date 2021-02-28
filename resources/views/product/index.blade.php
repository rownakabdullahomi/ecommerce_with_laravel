@extends('layouts.starlight')

@section('page_title')
    Product
@endsection

@section('product')
    active
@endsection

@section('content')
@include('layouts.nav')

<!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{ url('home') }}">Dashboard</a>
        <span class="breadcrumb-item active">Product</span>
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
                            {{-- <div class="alert alert-success text-center">
                                <h4>
                                    Total Category: {{ $total_categories }}
                                </h4>
                            </div> --}}
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Serial No</th>
                                        <th scope="col">Product Name</th>
                                        <th scope="col">Category Name</th>
                                        <th scope="col">Product Description</th>
                                        <th scope="col">Product Price</th>
                                        <th scope="col">Product Quantity</th>
                                        <th scope="col">Product Photo</th>
                                        {{-- <th scope="col">Added By</th>
                                        <th scope="col">Created at</th>
                                        <th scope="col">Action</th> --}}

                                    </tr>
                                </thead>

                                @foreach ($products as $key => $product)
                                    <tbody>
                                        <tr>
                                            <th>{{ $loop->index + 1 }}</th>
                                            {{-- <td>{{ $product }}</td> --}}
                                            <td>{{ $product->product_name }}</td>
                                            <td>{{ App\Models\Category::find($product->category_id)->category_name }}</td>
                                            <td>{{ $product->product_description }}</td>
                                            <td>{{ $product->product_price }}</td>
                                            <td>{{ $product->product_quantity }}</td>
                                            <td>
                                                <img src="{{ asset('uploads/product_photos') }}/{{ $product->product_photo }}" alt="" class="w-100" ">
                                            </td>
                                            {{-- <td>
                                                {{ App\Models\User::find($product->added_by)->name }}
                                                ({{ $product->added_by }})
                                                <br/>
                                                {{ App\Models\User::find($product->added_by)->email }}
                                            </td>
                                            <td>{{ $product->created_at }}</td>
                                            <td>
                                                <a href="{{ url('category/delete') }}/{{ $product->id }}" class="btn btn-danger btn-sm">Delete</a>
                                            </td> --}}
                                        </tr>
                                    </tbody>
                                @endforeach
                            </table>
                            {{-- {{ $categories->links() }} --}}
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            Add Product
                        </div>

                        <div class="card-body">
                            @if (session('productuploadstatus'))
                                <div class="alert alert-success">
                                    {{ session('productuploadstatus') }}
                                </div>
                            @endif

                            <form action="{{ url('product/insert') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Category Name</label>
                                    <select class="form-control" name="category_id" id="">
                                        <option value="">Select One</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Sub Category Name</label>
                                    <select class="form-control" name="sub_category_id" id="">
                                        <option value="">Select One</option>
                                        @foreach ($subcategories as $subcategory)
                                            <option value="{{ $subcategory->id }}">{{ App\Models\Category::find($subcategory->category_id)->category_name }}-{{ $subcategory->sub_category_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Product Name</label>
                                    <input type="text" class="form-control" name="product_name" id="">
                                    @error('category_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Product Description</label>
                                    <textarea class="form-control" rows="4" name="product_description"></textarea>
                                    @error('category_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Product Price</label>
                                    <input type="text" class="form-control" name="product_price" id="">
                                    @error('category_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Product Quantity</label>
                                    <input type="text" class="form-control" name="product_quantity" id="">
                                    @error('category_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Product Photo</label>
                                    <input type="file" class="form-control" name="product_photo" id="">
                                    @error('category_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Product Thumbnail Photos</label>
                                    <input type="file" class="form-control" name="product_thumbnail_photos[]" multiple id="">
                                    @error('category_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>



                                <button type="submit" class="btn btn-primary">Add Product</button>
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

