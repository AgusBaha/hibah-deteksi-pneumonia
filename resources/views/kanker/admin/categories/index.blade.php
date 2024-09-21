<x-app-layout title="Categories">
    @push('style')
    @endpush

    @if (session('success'))
    <div class="alert alert-success d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:">
            <use xlink:href="#info-fill" />
        </svg>
        <div>
            {{ session('success') }}
        </div>
    </div>

    <script>
        // Membuat pesan flash otomatis hilang setelah beberapa detik (misalnya 5 detik)
            setTimeout(function() {
                $('.alert').alert('close');
            }, 4000); // 5000 milidetik (5 detik)
    </script>
    @endif

    <div class="row">
        <div class="col-md-6">
            <!-- Menggunakan kolom setengah layar untuk formulir pencarian -->
            <a href="{{ route('categories.create') }}" class="btn btn-primary mb-2">Add New Categories</a>
        </div>
        <div class="col-md-6 text-md-end">

        </div>
    </div>

    <div class="card position-relative">
        <div class="card-body shadow">

            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->descriptions }}</td>
                        <td>
                            <a href="{{ route('categories.edit', $category->id) }}"
                                class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                                style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="d-flex mt-1">
        {!! $categories->links() !!}
    </div>

    @push('scripts')
    @endpush
</x-app-layout>