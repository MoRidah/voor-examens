@extends('layouts.app')

@section('title', 'Item Details')

@section('content')
<div class="container py-4">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="display-5 fw-bold text-primary">{{ is_array($item) ? $item['name'] : $item->name }}</h1>
            <p class="text-muted">Item ID: #{{ is_array($item) ? $item['id'] : $item->id }}</p>
        </div>
        <div class="col-md-4 text-md-end d-flex align-items-center justify-content-md-end">
            <a href="{{ route('items.edit', is_array($item) ? $item['id'] : $item->id) }}" class="btn btn-warning me-2">
                <i class="fas fa-edit me-1"></i>Edit
            </a>
            <a href="{{ route('items.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i>Back
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-light py-3">
                    <h5 class="card-title mb-0">Item Information</h5>
                </div>
                <div class="card-body p-4">
                    <div class="mb-4">
                        <h5 class="fw-bold text-secondary">Description</h5>
                        <p class="lead">{{ (is_array($item) ? $item['description'] : $item->description) ?: 'No description available' }}</p>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="card h-100 bg-light border-0">
                                <div class="card-body text-center p-4">
                                    <h5 class="fw-bold text-secondary mb-3">Price</h5>
                                    <p class="display-6 text-success mb-0">${{ number_format((float)(is_array($item) ? $item['price'] : $item->price), 2) }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="card h-100 bg-light border-0">
                                <div class="card-body text-center p-4">
                                    <h5 class="fw-bold text-secondary mb-3">Quantity</h5>
                                    <p class="display-6 text-primary mb-0">{{ is_array($item) ? $item['quantity'] : $item->quantity }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-light py-3">
                    <h5 class="card-title mb-0">Status</h5>
                </div>
                <div class="card-body p-4 text-center">
                    @if (is_array($item) ? $item['active'] : $item->active)
                        <div class="py-3">
                            <span class="badge bg-success p-3 fs-6 rounded-pill">
                                <i class="fas fa-check-circle me-2"></i>Active
                            </span>
                        </div>
                        <p class="text-muted mt-3">This item is currently active and visible to users.</p>
                    @else
                        <div class="py-3">
                            <span class="badge bg-danger p-3 fs-6 rounded-pill">
                                <i class="fas fa-times-circle me-2"></i>Inactive
                            </span>
                        </div>
                        <p class="text-muted mt-3">This item is currently inactive and hidden from users.</p>
                    @endif
                </div>
            </div>
            
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-light py-3">
                    <h5 class="card-title mb-0">Timestamps</h5>
                </div>
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between mb-3">
                        <span class="text-muted">Created:</span>
                        <span class="fw-bold">{{ is_array($item) ? $item['created_at'] : $item->created_at }}</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="text-muted">Last Updated:</span>
                        <span class="fw-bold">{{ is_array($item) ? $item['updated_at'] : $item->updated_at }}</span>
                    </div>
                </div>
            </div>
            
            <div class="card shadow-sm border-0 bg-light">
                <div class="card-body p-4">
                    <h5 class="card-title text-danger mb-3">Danger Zone</h5>
                    <form action="{{ route('items.destroy', is_array($item) ? $item['id'] : $item->id) }}" method="POST" class="d-grid">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" 
                                onclick="return confirm('Are you sure you want to delete this item? This action cannot be undone.')">
                            <i class="fas fa-trash-alt me-2"></i>Delete Item
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 