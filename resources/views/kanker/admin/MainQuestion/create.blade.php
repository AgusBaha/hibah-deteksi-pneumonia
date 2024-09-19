<x-app-layout title="Form Question">
    @push('style')
    @endpush

    <div class="card position-relative">
        <div class="card-body shadow">
            <form action="{{ route('main-questions.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="question">Question:</label>
                    <textarea name="question" id="question" class="form-control" required></textarea>
                </div>

                <div class="form-group">
                    <label for="weight">Weight:</label>
                    <input type="number" name="weight" id="weight" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>

    @push('scripts')
    @endpush
</x-app-layout>