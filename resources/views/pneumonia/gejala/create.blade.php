<x-app-layout title="Add New Gejala">
    @push('style')
    @endpush


    <div class="card position-relative">
        <div class="card-body shadow">

            <form method="POST" action="{{ route('gejala.store') }}">
                @csrf
                <div class="form-group">
                    <label for="NamaGejala">Nama Gejala</label>
                    <input type="text" name="nama" class="form-control" id="NamaGejala" placeholder="Nama Gejala...">
                </div>

                <div class="form-group">
                    <label for="BobotGejala">Bobot Gejala</label>
                    <input type="number" name="bobot" class="form-control" id="BobotGejala" placeholder="Bobot Gejala...">
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('gejala.index') }}" class="btn btn-danger">Back</a>
            </form>

        </div>
    </div>

    @push('scripts')
    @endpush
</x-app-layout>
