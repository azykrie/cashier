<div>
    <section class="content">
        <div class="container-fluid">
            <div class="row py-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header row mb-2">
                            <div class="col-sm-8">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#addProduct">
                                    + Create
                                </button>
                            </div>
                            <div class="col-sm-3 float-sm-right">
                                <input wire:model.live="search" class="form-control me-2" type="search"
                                    placeholder="Search" aria-label="Search">
                            </div>
                        </div>
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if (session('message'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('message') }}
                                </div>
                            @endif
                            <table class="table caption-top">
                                <thead>
                                    <tr>
                                        <th width="5%">NO</th>
                                        <th width="5%">NAME PRODUCT</th>
                                        <th width="5%">NAME CATEGORY</th>
                                        <th width="5%">STOCK</th>
                                        <th width="5%">PRICE</th>
                                        <th width="5%">ACTION</th>
                                    </tr>
                                </thead>
                                @foreach ($products as $product)
                                    <tbody>
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $product->product_name }}</td>
                                            <td>{{ $product->category->category_name}}</td>
                                            <td>{{ $product->stock }}</td>
                                            <td>{{ $product->price }}</td>
                                            <td>
                                                <button wire:click='edit({{ $product->id }})' type="button"
                                                    class="btn btn-warning">EDIT</button>
                                                <button
                                                    wire:confirm="Are you sure you want to delete this {{ $product->name }}"
                                                    wire:click='delete({{ $product->id }})'
                                                    class="btn btn-danger">DELETE</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                @endforeach
                            </table>
                        </div>
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
        @include('livewire.product.form')
        @include('livewire.product.edit')
    </section>
</div>

@push('scripts')
    <script>
        window.addEventListener('close-modal', event => {
            $('#addProduct').modal('hide');
            $('#editProduct').modal('hide'); // Adjusted the modal ID here
        });

        window.addEventListener('show-edit-product-modal', event => {
            $('#editProduct').modal('show');
        });
    </script>
@endpush