<x-app-layout title="Form Question">
    @push('style')
    @endpush

    <div class="card position-relative">
        <div class="card-body shadow">
            <form action="{{ route('specific-questions.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="main_question">Main Question:</label>
                    <select name="main_question_id" id="main_question" class="form-control" required>
                        <option value="">Select Main Question</option>
                        @foreach($mainQuestions as $mainQuestion)
                        <option value="{{ $mainQuestion->id }}">{{ $mainQuestion->question }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="question">Specific Question:</label>
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