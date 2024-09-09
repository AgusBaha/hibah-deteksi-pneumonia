<x-app-layout title="Form Question">
    @push('style')
    @endpush

    <div class="card position-relative">
        <div class="card-body shadow">
            <form action="{{ isset($question) ? route('question.update', $question->id) : route('question.store') }}"
                method="POST">
                @csrf
                @if(isset($question))
                @method('PUT')
                @endif
                <div class="form-group">
                    <label for="question_text">Pertanyaan:</label>
                    <input type="text" name="question_text" id="question_text" class="form-control"
                        value="{{ old('question_text', $question->question_text ?? '') }}" required>
                </div>
                <div class="form-group">
                    <label for="weight">Bobot (Weight):</label>
                    <input type="number" name="weight" id="weight" class="form-control"
                        value="{{ old('weight', $question->weight ?? 0) }}">
                </div>
                <div class="form-group">
                    <label for="parent_id">Pertanyaan Induk:</label>
                    <select name="parent_id" id="parent_id" class="form-control">
                        <option value="">Tidak Ada</option>
                        @foreach($mainQuestions as $mainQuestion)
                        <option value="{{ $mainQuestion->id }}" {{ isset($question) && $question->parent_id ==
                            $mainQuestion->id ?
                            'selected' : '' }}>
                            {{ $mainQuestion->question_text }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="is_main">Apakah ini pertanyaan utama?</label>
                    <input type="checkbox" name="is_main" id="is_main" {{ isset($question) && $question->is_main ?
                    'checked' : ''
                    }}>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
    {{-- {{ $dataBasisKasus->links() }} --}}
    <div class="d-flex mt-1">
        {{-- {!! $dataBasisKasus->links() !!} --}}
    </div>

    @push('scripts')

    @endpush
</x-app-layout>