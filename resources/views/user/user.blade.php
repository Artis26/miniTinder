@extends('layouts.app')
<head>
    <title>User profile</title>
    <style>

    </style>
</head>
@section('content')
    <div class="row py-5 px-4">
        <div class="col-xl-8 col-md-10 col-sm-14 mx-auto">

            <!-- Profile widget -->
            <div class="bg-white shadow rounded overflow-hidden">
                <div class="px-4 pt-4 pb-2 bg-dark">
                    <div class="media align-items-end profile-header">
                        <div class="profile mr-3"><img src="/storage/{{ $user->profile_picture }}" alt="..." width="250" class="rounded mb-2 img-thumbnail"></div>
                        <div class="media-body mb-0 text-white">
                            <h4 class="mt-0 mb-0">{{ $user->name }} {{ $user->surname }} </h4>
                            <p class="small mb-0"> <i class="fa fa-map-marker mr-2"></i> Country: {{ $user->country }} <br> City: {{ $user->city }} <br> Age: {{ $user->age }} <br> Gender: {{ $user->gender }}</p>
                        </div>
                        <div><a href="/edit" class="btn btn-danger btn-sm btn-block ">Edit profile</a></div>
                    </div>
                </div>

                <div class="bg-light p-4 d-flex justify-content-end text-center">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item">
                            <h5 class="font-weight-bold mb-0 d-block">241</h5><small class="text-muted"> <i class="fa fa-picture-o mr-1"></i>Photos</small>
                        </li>
                        <li class="list-inline-item">
                            <h5 class="font-weight-bold mb-0 d-block">84K</h5><small class="text-muted"> <i class="fa fa-user-circle-o mr-1"></i>Followers</small>
                        </li>
                    </ul>
                </div>

                <div class="py-4 px-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h5 class="mb-0">Recent photos</h5>
                        <form action="{{ url('/upload') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="picture" id="picture">
                            <input type="submit" value="Upload Image">
                        </form>
                        <a href="#" class="btn btn-link text-muted">Show all</a>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 mb-2 pr-lg-1"><img src="https://bootstrapious.com/i/snippets/sn-profile/img-3.jpg" alt="" class="img-fluid rounded shadow-sm"></div>
                        <div class="col-lg-6 mb-2 pl-lg-1"><img src="https://bootstrapious.com/i/snippets/sn-profile/img-4.jpg" alt="" class="img-fluid rounded shadow-sm"></div>
                        <div class="col-lg-6 pr-lg-1 mb-2"><img src="https://bootstrapious.com/i/snippets/sn-profile/img-5.jpg" alt="" class="img-fluid rounded shadow-sm"></div>
                        <div class="col-lg-6 pl-lg-1"><img src="https://bootstrapious.com/i/snippets/sn-profile/img-6.jpg" alt="" class="img-fluid rounded shadow-sm"></div>
                    </div>

                </div>
            </div><!-- End profile widget -->

        </div>
    </div>
@endsection
