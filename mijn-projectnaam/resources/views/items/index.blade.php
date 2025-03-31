@extends('layouts.app')

@section('title', 'Items List')

@section('content')
<div class="container py-4">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="display-5 fw-bold text-primary">Items Management</h1>
            <p class="text-muted">Browse, search and manage your inventory items.</p>
        </div>
        <div class="col-md-4 text-md-end d-flex align-items-center justify-content-md-end">
            <a href="{{ route('items.create') }}" class="btn btn-primary">
                <i class="fas fa-plus-circle me-2"></i>Create New Item
            </a>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-header bg-light py-3 d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">All Items</h5>
            <div class="input-group w-50">
                <input type="text" class="form-control" placeholder="Search items..." id="searchInput">
                <button class="btn btn-outline-secondary" type="button">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0" id="itemsTable">
                    <thead class="table-light">
                        <tr>
                            <th class="px-4 py-3">ID</th>
                            <th class="px-4 py-3">Name</th>
                            <th class="px-4 py-3">Price</th>
                            <th class="px-4 py-3">Quantity</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($items as $item)
                            <tr>
                                <td class="px-4 py-3">{{ is_array($item) ? $item['id'] : $item->id }}</td>
                                <td class="px-4 py-3 fw-bold">{{ is_array($item) ? $item['name'] : $item->name }}</td>
                                <td class="px-4 py-3 text-success">${{ number_format((float)(is_array($item) ? $item['price'] : $item->price), 2) }}</td>
                                <td class="px-4 py-3">{{ is_array($item) ? $item['quantity'] : $item->quantity }}</td>
                                <td class="px-4 py-3">
                                    @if (is_array($item) ? $item['active'] : $item->active)
                                        <span class="badge bg-success rounded-pill px-3">Active</span>
                                    @else
                                        <span class="badge bg-danger rounded-pill px-3">Inactive</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('items.show', is_array($item) ? $item['id'] : $item->id) }}" 
                                           class="btn btn-sm btn-outline-info" title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('items.edit', is_array($item) ? $item['id'] : $item->id) }}" 
                                           class="btn btn-sm btn-outline-warning" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('items.destroy', is_array($item) ? $item['id'] : $item->id) }}" 
                                              method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete"
                                                    onclick="return confirm('Are you sure you want to delete this item?')">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <div class="py-5">
                                        <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                                        <p class="h5 text-muted">No items found.</p>
                                        <a href="{{ route('items.create') }}" class="btn btn-primary mt-3">
                                            Create your first item
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white py-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <small class="text-muted">Showing {{ $items->count() }} of {{ $items->total() }} items</small>
                </div>
                <div>
                    {{ $items->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const table = document.getElementById('itemsTable');
    const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
    
    searchInput.addEventListener('keyup', function() {
        const searchText = searchInput.value.toLowerCase();
        
        for (let i = 0; i < rows.length; i++) {
            const rowText = rows[i].textContent.toLowerCase();
            if (rowText.indexOf(searchText) > -1) {
                rows[i].style.display = '';
            } else {
                rows[i].style.display = 'none';
            }
        }
    });
});
</script>
@endsection 