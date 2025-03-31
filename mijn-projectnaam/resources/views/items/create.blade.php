@extends('layouts.app')

@section('title', 'Create New Item')
@section('content')
<div class="container py-4">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="display-5 fw-bold text-primary">Create New Item</h1>
            <p class="text-muted">Fill in the details below to add a new item to your inventory.</p>
        </div>
        <div class="col-md-4 text-md-end d-flex align-items-center justify-content-md-end">
            <a href="{{ route('items.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>Back to List
            </a>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-header bg-light py-3">
            <h5 class="card-title mb-0">Item Information</h5>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('items.store') }}" method="POST">
                @csrf
                
                <div class="row">
                    <div class="col-md-8 mb-3">
                        <label for="name" class="form-label fw-bold">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" 
                               id="name" name="name" value="{{ old('name') }}" 
                               placeholder="Enter item name" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Choose a descriptive name for your item.</div>
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <label for="active" class="form-label fw-bold d-block">Status</label>
                        <div class="form-check form-switch mt-2">
                            <input class="form-check-input" type="checkbox" id="active" name="active" value="1" 
                                  {{ old('active') ? 'checked' : '' }} style="transform: scale(1.5); margin-left: -2.5em;">
                            <label class="form-check-label ms-2 mt-1" for="active">Active</label>
                        </div>
                        <div class="form-text">Inactive items won't appear in public listings.</div>
                    </div>
                </div>
                
                <div class="mb-4">
                    <label for="description" class="form-label fw-bold">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" 
                              id="description" name="description" rows="4" 
                              placeholder="Provide a detailed description of the item">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label for="price" class="form-label fw-bold">Price <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light">$</span>
                            <input type="number" class="form-control @error('price') is-invalid @enderror" 
                                   id="price" name="price" value="{{ old('price') }}" 
                                   step="0.01" min="0" placeholder="0.00" required>
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="quantity" class="form-label fw-bold">Quantity <span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('quantity') is-invalid @enderror" 
                               id="quantity" name="quantity" value="{{ old('quantity', 1) }}" 
                               min="0" placeholder="Enter quantity" required>
                        @error('quantity')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                    <button type="reset" class="btn btn-light btn-lg px-4 me-md-2">Reset</button>
                    <button type="submit" class="btn btn-primary btn-lg px-5">Create Item</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .form-control:focus, .form-check-input:focus {
        border-color: #86b7fe;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }
    .form-control-lg {
        font-size: 1.1rem;
    }
    .form-text {
        font-size: 0.85rem;
    }
</style>
@endsection 