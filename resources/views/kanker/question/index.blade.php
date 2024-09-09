<x-app-layout title="Question">
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
            <a href="{{ route('question.create') }}" class="btn btn-primary mb-2">Add New Question</a>
        </div>
        <div class="col-md-6 text-md-end">
            <!-- Menggunakan kolom setengah layar untuk tombol "Add New Gejala" dan mengatur teks ke kanan -->
            <form action="#" method="GET" class="mb-2">
                <div class="input-group">
                    <input type="text" class="form-control mr-1" placeholder="Cari Question..." name="search"
                        value="{{ request('search') }}" style="width: 150px;">
                    @if (request('search'))
                    <div class="input-group-append">
                        <a href="#" class="btn btn-outline-danger"
                            style="border-top-left-radius: 0; border-bottom-left-radius: 0;">
                            <i class="fa fa-times"></i> <!-- Icon "X" -->
                        </a>
                    </div>
                    @else
                    <button class="btn btn-outline-primary" type="submit">
                        <i class="fa fa-search"></i> <!-- Icon "Search" -->
                    </button>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <div class="card position-relative">
        <div class="card-body shadow">

            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Pertanyaan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($questions as $question)
                    <tr>
                        <td>{{ $question->id }}</td>
                        <td>{{ $question->question_text }}</td>
                        <td>
                            <a href="{{ route('question.edit', $question->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('question.destroy', $question->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
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
    <script>
        // JavaScript untuk mengubah icon pada tombol "Cari" menjadi tombol "Clear"
            document.getElementById('clearSearchButton').addEventListener('click', function() {
                document.querySelector('input[name="search"]').value = '';
                this.style.display = 'none'; // Sembunyikan tombol "Clear"
                document.querySelector('button[type="submit"]').innerHTML =
                    '<i class="fa fa-search"></i>'; // Kembalikan icon "Cari"
            });
    </script>
    @endpush
</x-app-layout>