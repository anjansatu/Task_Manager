@extends('user.layouts.master')

@section('user-content')
    <!-- Page Header -->
    <div class="page-header">
        <div>
            <h2 class="main-content-title tx-24 mg-b-5">Profile</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">User</a></li>
                <li class="breadcrumb-item active" aria-current="page">Profile</li>
            </ol>
        </div>
    </div>
    <!-- End Page Header -->

    <!-- Row -->
    <div class="row row-sm">
        <div class="col-lg-4 col-xl-3">
            <div class="card custom-card">
                <div class="card-header">
                    <h5>User Details</h5>
                </div>
                <div class="card-body">
                    <div class="main-content-left main-content-left-mail">
                        <div class="main-mail-menu">
                            <nav class="nav main-nav-column mg-b-20">
                                <!-- Display the user details here -->
                                <p><strong>Name:</strong> {{ $user->name }}</p>
                                <p><strong>Email:</strong> {{ $user->email }}</p>
                                <p><strong>Joined:</strong> {{ $user->created_at->format('M d, Y') }}</p>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8 col-xl-9">
            <div class="row row-sm">
                <div class="col-lg-12 col-md-12">
                    <!-- Change Password Card -->
                    <div class="card custom-card main-content-body-profile">
                        <div class="tab-content">
                            <div class="main-content-body tab-pane p-4 border-top-0 active" id="about">
                                <div class="card-body border">
                                    <div class="mb-4 main-content-label">Privacy & Security</div>
                                    <form class="form-horizontal" action="{{route('user.changePassword')}}" method="POST">
                                        @csrf
                                        <div class="form-group ">
                                            <div class="row row-sm">
                                                <div class="col-md-3">
                                                    <label class="form-label">Old Password</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <input type="password" class="form-control" name="old_password" placeholder="*****">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <div class="row row-sm">
                                                <div class="col-md-3">
                                                    <label class="form-label">New Password</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <input type="password" name="password" class="form-control" placeholder="*****" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <div class="row row-sm">
                                                <div class="col-md-3">
                                                    <label class="form-label">Confirm Password</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <input type="password" name="confirm_password" class="form-control" placeholder="*****" >
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group mb-0">
                                            <div class="row row-sm">
                                                <div class="col-md-3"></div>
                                                <div class="col-md-9">
                                                    <div class="form-controls-stacked">
                                                        <button type="submit" class="btn ripple btn-primary pd-x-30 mg-r-5">Update</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Change Password Card -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Row -->
@endsection
