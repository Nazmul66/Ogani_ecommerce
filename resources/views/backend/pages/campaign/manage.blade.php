@extends('backend.layout.template')

@section('page-titles')
    <title>Manage Campaign | Admin Dashboard </title>
@endsection

@section('body-content')
   <!-- pageheader  -->
   <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <nav aria-label="breadcrumb" style="background: #FFF">
                    <ol class="breadcrumb justify-content-between align-items-center">
                        <div class="d-flex">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="breadcrumb-link">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Manage Campaign</li>
                        </div>

                        <a href="{{ route('campaign.create') }}">
                            <button class="btn btn-dark ">Create Campaign</button>
                        </a>
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
                    <h5 class="mb-0">Manage Campaign</h5>
                    <a href="{{ route('campaign.trash-manage') }}">
                        <button class="btn btn-dark ">Manage Trash Folder</button>
                    </a>
                </div>
                  <div class="card-body">

                    @if ( $campaigns->count() == 0 )
                        <div class="alert alert-danger" role="alert">
                           Oops! there is no campaigns data here.
                        </div>
                    @else
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Start Date</th>
                                <th scope="col">Title</th>
                                <th scope="col">Image</th>
                                <th scope="col">Discount(%)</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            
                            <tbody>
                                @foreach ( $campaigns as $campaign )
                                    <tr>
                                        <th scope="row">{{ $campaign->start_date }}</th>
                                        <td>{{ $campaign->title }}</td>
                                        <td>
                                            <img src="{{ asset('backend/uploads/campaigns/' . $campaign->image )  }}" alt="" style="width: 75px; height: 75px;">
                                        </td>
                                        <td>{{ $campaign->discount }}%</td>
                                        <td>
                                            @if ( $campaign->status == 1 )
                                            <span class="badge-text-primary">Active</span>
                                            @elseif ( $campaign->status == 2 ) 
                                            <span class="badge-text-Danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <ul class="action_list">
                                                <li style="background: #157347;">
                                                    <a href="{{ route('campaign.edit', $campaign->id) }}"><i class="far fa-edit"></i></a> 
                                                </li>
                                                <li style="background: #BB2D3B;">
                                                    <span data-toggle="modal" data-target="#campaign{{ $campaign->id }}"><i class="fas fa-trash"></i></span> 
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>


                                    <!-- Modal start -->
                                    <div class="modal fade" id="campaign{{ $campaign->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                    
                                                    <a href="{{ route('campaign.destroy', $campaign->id) }}" class="btn btn-primary">Confirm</a>
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

