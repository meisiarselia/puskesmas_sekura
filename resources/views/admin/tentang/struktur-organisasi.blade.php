@extends('layouts.admin.app', [
    'title' => 'Struktur Organisasi',
])
@section('main')
    <div class="p-0 p-sm-3">
        <div class="card card-body border-0 shadow-sm">
            <div class="d-flex justify-content-between align-items-center">
                <span id="nama_gambar">
                    {{ $so->nama_gambar }}
                </span>
                <form action="/admin/tentang/struktur-organisasi" class="d-flex" style="gap: .5rem" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <button type="button" class="btn btn-dark" id="ubahButton">Ubah</button>
                    <input type="file" name="file" class="d-none" id="fileInput">
                    <button type="button" class="btn btn-danger d-none" id="batalButton">Batal</button>
                    <button type="submit" class="btn btn-success d-none" id="simpanButton">Simpan</button>
                </form>
            </div>
            @error('file')
                <div class="text-danger text-right">
                    {{ $message }}
                </div>
            @enderror
            <img class="mt-3" src="{{ asset($so->nama_gambar) }}" alt="" id="previewImage">
        </div>
    </div>
@endsection
@push('js')
    <script>
        const ubahButton = document.getElementById('ubahButton');
        const fileInput = document.getElementById('fileInput');
        const simpanButton = document.getElementById('simpanButton');
        const batalButton = document.getElementById('batalButton');
        const previewImage = document.getElementById('previewImage');
        const originalSrc = previewImage.src;

        ubahButton.addEventListener('click', function() {
            fileInput.click();
        });

        fileInput.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                }
                reader.readAsDataURL(file);
                simpanButton.classList.remove('d-none');
                batalButton.classList.remove('d-none');
            }
        });

        batalButton.addEventListener('click', function() {
            previewImage.src = originalSrc;
            simpanButton.classList.add('d-none');
            batalButton.classList.add('d-none');
            fileInput.value = ''; // Clear the file input
        });
    </script>
    @if (session()->has('success'))
        <script>
            Success.fire({
                text: "{{ session()->get('success') }}"
            })
        </script>
    @endif
@endpush
