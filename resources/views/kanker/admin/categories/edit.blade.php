<x-app-layout title="Form Question">
    @push('style')
    @endpush

    <div class="card position-relative">
        <div class="card-body shadow">
            <form action="{{ route('categories.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $category->name }}"
                        required>
                </div>
                <div class="form-group">
                    <label for="descriptions">Description:</label>
                    <textarea name="descriptions" id="descriptions"
                        class="form-control">{{ $category->descriptions }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>

    @push('scripts')
    @push('scripts')
    <!-- CDN TinyMCE -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/7.3.0/tinymce.min.js"
        integrity="sha512-RUZ2d69UiTI+LdjfDCxqJh5HfjmOcouct56utQNVRjr90Ea8uHQa+gCxvxDTC9fFvIGP+t4TDDJWNTRV48tBpQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        tinymce.init({
                    selector: '#descriptions', // Targetkan textarea dengan id descriptions
                    plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                    toolbar_mode: 'floating',
                    menubar: false, // Menyembunyikan menu bar
                    height: 300, // Sesuaikan tinggi editor
                    toolbar: 'undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                });
    </script>
    @endpush
    @endpush
</x-app-layout>