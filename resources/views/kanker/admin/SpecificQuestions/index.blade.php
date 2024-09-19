<x-app-layout title="Specific Question">
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
            <a href="{{ route('specific-questions.create') }}" class="btn btn-primary mb-2">Add Specific Questions</a>
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
                        <th>Main Question</th>
                        <th>Question</th>
                        <th>Weight</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($specificQuestions as $specificQuestion)
                    <tr>
                        <td>{{ $specificQuestion->id }}</td>
                        <td>{{ $specificQuestion->mainQuestion->question }}</td>
                        <td>{{ $specificQuestion->question }}</td>
                        <td>{{ $specificQuestion->weight }}</td>
                        <td>
                            <a href="{{ route('specific-questions.edit', $specificQuestion->id) }}"
                                class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('specific-questions.destroy', $specificQuestion->id) }}"
                                method="POST" style="display:inline-block;">
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
    {{-- {{ $dataBasisKasus->links() }} --}}
    <div class="d-flex mt-1">
        {{-- {!! $dataBasisKasus->links() !!} --}}
    </div>

    @push('scripts')
    @endpush
</x-app-layout>