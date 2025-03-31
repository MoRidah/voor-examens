@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h2 class="mb-4">Welcome, {{ Auth::user()->name }}!</h2>
                    
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Item Management</h5>
                                    <p class="card-text">Manage your inventory items.</p>
                                    <div class="d-grid gap-2">
                                        <a href="{{ route('items.index') }}" class="btn btn-primary">View All Items</a>
                                        <a href="{{ route('items.create') }}" class="btn btn-success">Create New Item</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Account Settings</h5>
                                    <p class="card-text">Manage your account information.</p>
                                    <div class="d-grid gap-2">
                                        <a href="{{ route('profile.edit') }}" class="btn btn-info">Edit Profile</a>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-danger w-100">Logout</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <h3 class="mb-3">Recent Activity</h3>
                    <div class="list-group">
                        <a href="{{ route('items.index') }}" class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">View Items</h5>
                                <small>Now</small>
                            </div>
                            <p class="mb-1">Browse all items in your inventory.</p>
                        </a>
                        <a href="{{ route('items.create') }}" class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">Create New Item</h5>
                                <small>Now</small>
                            </div>
                            <p class="mb-1">Add a new item to your inventory.</p>
                        </a>
                        <a href="{{ route('profile.edit') }}" class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">Update Profile</h5>
                                <small>Now</small>
                            </div>
                            <p class="mb-1">Update your account information.</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
