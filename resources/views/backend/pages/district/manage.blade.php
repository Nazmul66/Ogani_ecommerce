@extends('backend.layout.template')

@section('page-titles')
    <title>Manage District | Admin Dashboard </title>
@endsection

@section('body-content')
   <!-- pageheader  -->
   <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <nav aria-label="breadcrumb" style="background: #FFF">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="breadcrumb-link">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Manage District</li>
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
                <div class="d-flex justify-content-between align-items-center card-header ">
                    <h5 class="mb-0">Manage District</h5>
                    <a href="{{ route('district.trash-manage') }}">
                        <button class="btn btn-dark ">Manage Trash Folder</button>
                    </a>
                </div>
                  <div class="card-body">

                    @if ( $districts->count() == 0 )
                        <div class="alert alert-danger" role="alert">
                           Oops! there is no districts data here.
                        </div>
                    @else
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#Sl.</th>
                                <th scope="col">Country Name</th>
                                <th scope="col">Division Name</th>
                                <th scope="col">District Name</th>
                                <th scope="col">Shipping Cost</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>

                            <tbody>
                                @foreach ( $districts as $key => $district )
                                    <tr>
                                        <th scope="row">{{ $key + 1 }}</th>
                                        <td>
                                            @foreach ($countries as $country)
                                                @if ( $country->id == $district->country_id)
                                                  {{$country->name}}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($divisions as $division)
                                                @if ( $division->id == $district->division_id)
                                                  {{$division->division_name}}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>{{ $district->district_name }}</td>
                                        <td>{{ $setting->currency }} {{ $district->cash }}/-</td>
                                        <td>
                                            @if ( $division->status === 1 )
                                               <span class="badge badge-primary">Active</span>
                                            @else
                                                <span class="badge badge-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <ul class="action_list">
                                                <li style="background: #157347;">
                                                    <a href="{{ route('district.edit', $district->id) }}"><i class="far fa-edit"></i></a> 
                                                </li>
                                                <li style="background: #BB2D3B;">
                                                    <span data-toggle="modal" data-target="#district{{ $district->id }}"><i class="fas fa-trash"></i></span> 
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>

                                    <!-- Modal start -->
                                    <div class="modal fade" id="district{{ $district->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Do you want to delete this data!</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <div class="modal-body text-center">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    
                                                    <a href="{{ route('district.destroy', $district->id) }}" class="btn btn-primary">Confirm</a>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal end -->
                                @endforeach
                            </tbody>
                        </table>
                    @endif

                  </div>
            </div>
        </div>
    </div>


@endsection

