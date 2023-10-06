<x-app-layout title="Add New Basis Kasus">
    @push('style')
    @endpush

    <div class="row">
        <div class="col-md-6">
            <div class="card position-relative">
                <div class="card-body shadow">
                    <form method="POST" action="{{ route('basiskasus.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="idBasisKasus">ID Basis</label>
                            <input type="text" disabled name="idBasisKasus" class="form-control" id="idBasisKasus"
                                placeholder="ID Basis Kasus...">
                        </div>

                        <div class="form-group">
                            <label for="namaBasisKasus">Nama Basis Kasus</label>
                            <input type="text" name="namaBasisKasus" class="form-control" id="namaBasisKasus"
                                placeholder="Nama Basis Kasus...">
                        </div>

                        <div class="form-group">
                            <label for="detailBasisKasus">Detail Basis Kasus</label>
                            <textarea name="detailBasisKasus" class="form-control" id="detailBasisKasus" placeholder="Detail Basis Kasus..."></textarea>
                        </div>

                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card position-relative">
                <div class="card-body shadow">
                    <div class="form-group">
                        <label for="gejala">Pilih Gejala:</label>
                        <select name="gejala[]" id="gejala" class="form-control" multiple>
                            @foreach ($gejalaOptions as $gejala)
                                <option value="{{ $gejala->id }}">{{ $gejala->nama_gejala }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{ route('basiskasus.index') }}" class="btn btn-danger">Back</a>
                </div>
            </div>
        </div>
        </form>
    </div>

    @push('scripts')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                // Fungsi untuk menghasilkan ID Basis
                function generateId() {
                    $.ajax({
                        type: "GET", // Atau "POST" tergantung pada kebutuhan Anda
                        url: "/generate-id-basis", // Ganti dengan URL yang sesuai
                        success: function(data) {
                            $("#idBasisKasus").val(data); // Set nilai input ID Basis
                            $("#generatedId").text(data); // Tampilkan ID Basis di dalam span
                        }
                    });
                }

                // Panggil fungsi generateId saat halaman dimuat
                generateId();
            });
        </script>
    @endpush
</x-app-layout>
