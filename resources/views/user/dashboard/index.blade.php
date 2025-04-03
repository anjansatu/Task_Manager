@extends('user.layouts.master')

@section('user-content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @auth()
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <div class="container">
                                <h2 class="mb-4">Dashboard Overview</h2>
                                <!-- Cards for total tasks -->
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <div class="card">
                                            <a href="" class="text-dark text-decoration-none">
                                                <div class="card-body">
                                                    <h5 class="card-title">Last Deposit</h5>
                                                    <p class="card-text">{{ max(auth()->user()->tasks()->pending()->count(), 0) }}</p>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card">
                                            <a href="" class="text-dark text-decoration-none">
                                                <div class="card-body">
                                                    <h5 class="card-title">Total Purchase SSN</h5>
                                                    <p class="card-text">{{ max(auth()->user()->tasks()->inProgress()->count(), 0) }}</p>
                                                </div>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="card">
                                            <a href="" class="text-dark text-decoration-none">
                                                <div class="card-body">
                                                    <h5 class="card-title">Status</h5>
                                                    <button class="btn {{ auth()->user()->status == STATUS_ACTIVE ? 'btn-primary' : 'btn-secondary' }}"
                                                        {{ auth()->user()->status == STATUS_ACTIVE ? '' : 'disabled' }}>
                                                    {{ auth()->user()->status == STATUS_ACTIVE ? 'Active' : 'Inactive' }}
                                                </button>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Show this card if user status is inactive -->
                                @if(auth()->user()->status == STATUS_INACTIVE)
                                    <div class="alert alert-warning mt-3">
                                        <strong>Notice:</strong> After Activate your Account by top up a minimum of 30$ then you can buy the Doc's from SSN Panel on your Dashboard.
                                    </div>

                                    <!-- Image Slider -->
                                    <div id="dashboardCarousel" class="carousel slide mt-3" data-bs-ride="carousel">
                                        <div class="carousel-inner">
                                            <div class="carousel-item active">
                                                <img src="{{ asset('assets/images/slide/sld1.jpeg') }}" class="d-block w-100" alt="Slide 1">
                                            </div>
                                            <div class="carousel-item">
                                                <img src="{{ asset('assets/images/slide/sld2.jpeg') }}" class="d-block w-100" alt="Slide 2">
                                            </div>
                                            <div class="carousel-item">
                                                <img src="{{ asset('assets/images/slide/sld4.jpeg') }}" class="d-block w-100" alt="Slide 3">
                                            </div>
                                             <div class="carousel-item">
                                                <img src="{{ asset('assets/images/slide/sld5.jpeg') }}" class="d-block w-100" alt="Slide 4">
                                            </div>
                                             <div class="carousel-item">
                                                <img src="{{ asset('assets/images/slide/sld3.jpeg') }}" class="d-block w-100" alt="Slide 5">
                                            </div>
                                        </div>
                                        <a class="carousel-control-prev" href="#dashboardCarousel" role="button" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#dashboardCarousel" role="button" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </a>
                                    </div>

                                    <!-- Video Section -->
                                   <div class="mt-4 text-center">
                                        <h5>Watch the Tutorial</h5>
                                        <video width="100%" height="315" controls>
                                            <source src="{{ asset('assets/images/slide/tutorial.mp4') }}" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                    </div>
                                @endif
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
