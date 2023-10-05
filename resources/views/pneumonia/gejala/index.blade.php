<x-app-layout title="Gejala">
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
        <div class="col-md-6"> <!-- Menggunakan kolom setengah layar untuk formulir pencarian -->
            <a href="{{ route('gejala.create') }}" class="btn btn-primary mb-2">Add New Gejala</a>
        </div>
        <div class="col-md-6 text-md-end">
            <!-- Menggunakan kolom setengah layar untuk tombol "Add New Gejala" dan mengatur teks ke kanan -->
            <form action="{{ route('gejala.index') }}" method="GET" class="mb-2">
                <div class="input-group">
                    <input type="text" class="form-control mr-1" placeholder="Cari gejala..." name="search"
                        value="{{ request('search') }}" style="width: 150px;">
                    <button class="btn btn-outline-primary" type="submit">Cari</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card position-relative">
        <div class="card-body shadow">

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Gejala</th>
                        <th>Bobot Gejala</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $currentPage = $dataGejala->currentPage();
                        $perPage = $dataGejala->perPage();
                        $index = ($currentPage - 1) * $perPage + 1;
                    @endphp

                    @forelse ($dataGejala as $gejala)
                        <tr>
                            <td>{{ $index++ }}</td> <!-- Menampilkan nomor otomatis -->
                            <td>{{ $gejala->nama_gejala }}</td>
                            <td>{{ $gejala->bobot }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('gejala.edit', $gejala->id) }}"
                                        class="btn btn-warning btn-sm mr-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path
                                                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                            <path fill-rule="evenodd"
                                                d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                        </svg> Edit
                                    </a>
                                    <form action="{{ route('gejala.delete', ['id' => $gejala->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                <path
                                                    d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z" />
                                                <path
                                                    d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z" />
                                            </svg> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <div class="alert alert-danger">
                            Data Gejala Belum Tersedia
                        </div>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>
    {{-- {{ $dataGejala->links() }} --}}
    <div class="d-flex mt-1">
        {!! $dataGejala->links() !!}
    </div>

    @push('scripts')
    @endpush
</x-app-layout>
