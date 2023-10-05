<x-app-layout title="Add New Gejala">
    @push('style')
    @endpush


    <div class="card position-relative">
        <div class="card-body shadow">

            <form method="POST" action="{{ route('gejala.update', ['id' => $data->id]) }}">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="NamaGejala">Nama Gejala</label>
                    <input type="text" name="nama" class="form-control" id="NamaGejala" value="{{ $data->nama_gejala }}">
                </div>

                <div class="form-group">
                    <label for="BobotGejala">Bobot Gejala</label>
                    <input type="number" name="bobot" class="form-control" id="BobotGejala" value="{{ $data->bobot }}">
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('gejala.index') }}" class="btn btn-danger">Back</a>
            </form>

        </div>
    </div>

    @push('scripts')
    @endpush
</x-app-layout>
