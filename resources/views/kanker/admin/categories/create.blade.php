<x-app-layout title="Form Question">
    @push('style')
    @endpush

    <div class="card position-relative">
        <div class="card-body shadow">
            <form action="{{ route('categories.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="descriptions">Description:</label>
                    <textarea name="descriptions" id="descriptions" class="form-control"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>

    @push('scripts')
    @endpush
</x-app-layout>