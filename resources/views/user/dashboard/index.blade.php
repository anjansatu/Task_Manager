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
                                                        {{ auth()->user()->status ==  STATUS_ACTIVE ? '' : 'disabled' }}>
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
                                        <strong>Notice:</strong> AFTER ACTIVATE YOUR ACCOUNT BY TOP UP THEN YOU WILL SEE THE PANEL ON YOUR DASHBOARD.
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
