<x-app-layout title="Form Question">
    @push('style')
    @endpush

    <div class="card position-relative">
        <div class="card-body shadow">
            <form action="{{ route('specific-questions.update', $specificQuestion->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="main_question">Main Question:</label>
                    <select name="main_question_id" id="main_question" class="form-control" required>
                        @foreach($mainQuestions as $mainQuestion)
                        <option value="{{ $mainQuestion->id }}" {{ $specificQuestion->main_question_id ==
                            $mainQuestion->id ?
                            'selected' : '' }}>
                            {{ $mainQuestion->question }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="question">Specific Question:</label>
                    <textarea name="question" id="question" class="form-control"
                        required>{{ $specificQuestion->question }}</textarea>
                </div>

                <div class="form-group">
                    <label for="weight">Weight:</label>
                    <input type="number" name="weight" id="weight" class="form-control"
                        value="{{ $specificQuestion->weight }}" required>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>

    @push('scripts')
    @endpush
</x-app-layout>