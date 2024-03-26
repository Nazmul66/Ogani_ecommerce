@extends('backend.layout.template')

@section('page-titles')
    <title>Manage Customer | Admin Dashboard </title>
@endsection

@section('body-content')
   <!-- pageheader  -->
   <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <nav aria-label="breadcrumb" style="background: #FFF">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="breadcrumb-link">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Manage Customer</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
   <!-- end pageheader  -->

    <!-- body content start here -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Manage Customer</h5>
                </div>
                  <div class="card-body">

                    @if ( $customers->count() == 0 )
                        <div class="alert alert-danger" role="alert">
                           Oops! there is no customers data here.
                        </div>
                    @else
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#Sl.</th>
                                <th scope="col">Customer Name</th>
                                <th scope="col">Customer Email</th>
                                <th scope="col">Customer Phone</th>
                                <th scope="col">ZipCode</th>
                                <th scope="col">Status</th>
                                <th scope="col">Role</th>
                            </tr>
                            </thead>
                            
                            <tbody>
                                @foreach ( $customers as $key=>$customer )
                                    <tr>
                                        <th scope="row">{{ $key + 1 }}</th>
                                        <td>{{ $customer->name }}</td>
                                        <td>{{ $customer->email }}</td>
                                        <td>{{ $customer->phone }}</td>
                                        <td>{{ $customer->zipCode }}</td>
                                        <td>
                                            @if ( $customer->status == 1 )
                                               <span class="badge badge-primary">Active</span>
                                            @elseif( $customer->status == 0 )
                                                <span class="badge badge-danger">InActive</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ( $customer->role === 1 )
                                                <span class="badge badge-success">Admin</span>
                                            @elseif( $customer->role === 2 )
                                                <span class="badge badge-dark">User</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif

                  </div>
            </div>
        </div>
    </div>


@endsection

