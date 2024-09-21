@extends('layouts.home')

@section('content')
<header class="header-2">
    <div class="page-header min-vh-75 relative" style="background-image: url('{{ asset('Assets/img/kanker.jpg') }}')">
        <span class="mask bg-gradient-primary opacity-4"></span>
        <div class="container">
            <div class="row">
                <div class="col-lg-7 text-center mx-auto">
                    <h1 class="text-white pt-3 mt-n5">Konsultasi Online</h1>
                    <p class="lead text-white mt-3">Silahkan dapat Mengisi Data Berikut. <br /></p>
                    <a href="{{ route('deteksi.index') }}" class="btn bg-white text-dark">Konsultasi</a>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="card card-body blur shadow-blur mx-3 mx-md-4 mt-n6">
    <div class="container mt-5">
        <h1>Deteksi Kanker</h1>

        <div id="question-area">
            @if (isset($mainQuestion) || isset($specificQuestion))
            <h3 id="question-label">
                @if ($question_type == 'main')
                <span class="badge bg-primary">Main Question</span>
                @else
                <span class="badge bg-secondary">Specific Question</span>
                @endif
            </h3>

            <p id="question-text">{{ isset($mainQuestion) ? $mainQuestion->question : $specificQuestion->question }}</p>

            <input type="hidden" id="question-id"
                value="{{ isset($mainQuestion) ? $mainQuestion->id : $specificQuestion->id }}">
            <input type="hidden" id="question-type" value="{{ $question_type }}">
            <input type="hidden" id="yes-count" value="0">
            <input type="hidden" id="category-id" value="">

            <div class="btn-group">
                <button class="btn btn-success" onclick="submitAnswer('yes')">IYA</button>
                <button class="btn btn-danger" onclick="submitAnswer('no')">TIDAK</button>
            </div>
            @else
            <p>Tidak ada pertanyaan yang tersedia saat ini.</p>
            @endif
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    function submitAnswer(answer) {
        let questionId = document.getElementById('question-id').value;
        let questionType = document.getElementById('question-type').value;
        let yesCount = document.getElementById('yes-count').value;
        let categoryId = document.getElementById('category-id').value;

        $.ajax({
            url: '{{ route("deteksi.process") }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                answer: answer,
                current_question_id: questionId,
                question_type: questionType,
                yes_count: yesCount,
                category_id: categoryId
            },
            success: function(response) {
                if (response.status === 'complete') {
                    $('#question-area').html('<p>' + response.message + '</p>');

                    // Tampilkan deskripsi kategori jika ada
                    if (response.category_description) {
                        $('#question-area').append('<p><strong>Deskripsi Kategori: </strong>' + response.category_description + '</p>');
                    }
                    return;
                }

                // Update the question label
                $('#question-label').html(response.question_type === 'main' ?
                    '<span class="badge bg-primary">Main Question</span>' :
                    '<span class="badge bg-secondary">Specific Question</span>'
                );

                // Update the question text and hidden fields
                $('#question-text').text(response.question);
                $('#question-id').val(response.question_id);
                $('#question-type').val(response.question_type);
                $('#yes-count').val(response.yes_count);
                $('#category-id').val(response.category_id || '');
            },
            error: function(xhr) {
                alert('Error! Could not process your answer.');
            }
        });
    }
</script>
@endsection