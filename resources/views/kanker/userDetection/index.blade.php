@extends('layouts.home')

@section('content')
<div class="container mt-5">
    <h1>Deteksi Kanker</h1>

    @if (isset($mainQuestion))
    <form method="POST" action="{{ route('user.detection.answer', $mainQuestion->id) }}">
        @csrf
        <div class="form-group">
            <label>{{ $mainQuestion->question_text }}</label>
            <div class="form-check">
                <input type="radio" name="answer" value="1" class="form-check-input" id="answerYes">
                <label for="answerYes" class="form-check-label">YA</label>
            </div>
            <div class="form-check">
                <input type="radio" name="answer" value="0" class="form-check-input" id="answerNo">
                <label for="answerNo" class="form-check-label">TIDAK</label>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Lanjutkan</button>
    </form>
    @elseif (isset($nextQuestion))
    <form method="POST" action="{{ route('user.detection.answer', $nextQuestion->id) }}">
        @csrf
        <div class="form-group">
            <label>{{ $nextQuestion->question_text }}</label>
            <div class="form-check">
                <input type="radio" name="answer" value="1" class="form-check-input" id="answerYes">
                <label for="answerYes" class="form-check-label">YA</label>
            </div>
            <div class="form-check">
                <input type="radio" name="answer" value="0" class="form-check-input" id="answerNo">
                <label for="answerNo" class="form-check-label">TIDAK</label>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Lanjutkan</button>
    </form>
    @endif
</div>
@endsection