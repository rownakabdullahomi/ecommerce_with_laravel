@extends('layouts.starlight')

@section('page_title')
    Coupon
@endsection

@section('coupon')
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
                            Coupon List
                        </div>

                        <div class="card-body">
                            <div class="alert alert-success text-center">
                                <h4>
                                    {{-- Total Category: {{ $total_categories }} --}}
                                </h4>
                            </div>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Serial No</th>
                                        <th scope="col">Coupon Name</th>
                                        <th scope="col">Coupon Discount Amount</th>
                                        <th scope="col">Coupon Validity Till</th>
                                        <th scope="col">Created at</th>
                                        <th scope="col">Action</th>

                                    </tr>
                                </thead>

                                @foreach ($coupons as $coupon)
                                    <tbody>
                                        <tr>
                                            <th>{{ $loop->index + 1 }}</th>
                                            <td>{{ $coupon->coupon_name }}</td>
                                            <td>{{ $coupon->coupon_discount_amount }}</td>
                                            <td>{{ Carbon\Carbon::parse($coupon->coupon_validity_till)->diffForHumans() }}</td>
                                            <td>{{ $coupon->created_at }}</td>
                                        </tr>
                                @endforeach
                                    </tbody>
                            </table>
                            {{-- {{ $categories->links() }} --}}
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            Add Coupon
                        </div>

                        <div class="card-body">
                            @if (session('insertstatus'))
                                <div class="alert alert-success">
                                    {{ session('insertstatus') }}
                                </div>
                            @endif

                            <form action="{{ route('roadofcouponinsert') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label>Coupon Name</label>
                                    <input type="text" class="form-control" name="coupon_name" id="coupon_name">
                                    @error('category_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Coupon Discount Amount(%)</label>
                                    <input type="text" class="form-control" name="coupon_discount_amount" id="coupon_discount_amount">
                                    @error('category_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Coupon Validity Till</label>
                                    <input type="date" class="form-control" name="coupon_validity_till" id="coupon_validity_till">
                                    @error('category_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>


                                <button type="submit" class="btn btn-primary">Add Coupon</button>
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

