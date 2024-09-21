<x-app-layout title="Form Question">
    @push('style')
    <!-- Tambahkan link TinyMCE jika perlu -->
    @endpush

    <div class="card position-relative">
        <div class="card-body shadow">
            <form action="{{ route('categories.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="descriptions">Description:</label>
                    <textarea name="descriptions" id="descriptions" class="form-control"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>

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
</x-app-layout>