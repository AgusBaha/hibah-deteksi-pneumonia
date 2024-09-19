<x-app-layout title="Form Question">
    @push('style')
    @endpush

    <div class="card position-relative">
        <div class="card-body shadow">
            <form action="{{ route('main-questions.update', $mainQuestion->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="category">Category:</label>
                    <select name="category_id" id="category" class="form-control" required>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $mainQuestion->category_id == $category->id ? 'selected'
                            : '' }}>
                            {{ $category->name }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="question">Main Question:</label>
                    <textarea name="question" id="question" class="form-control"
                        required>{{ $mainQuestion->question }}</textarea>
                </div>

                <div class="form-group">
                    <label for="weight">Weight:</label>
                    <input type="number" name="weight" id="weight" class="form-control"
                        value="{{ $mainQuestion->weight }}" required>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>

    @push('scripts')
    @endpush
</x-app-layout>