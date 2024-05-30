@extends('layouts.admin.app', [
    'title' => 'Kontak',
])
@section('main')
    <div class="p-0 p-sm-3">
        <div class="card card-body border-0 shadow-sm">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="m-0">Kontak</h4>
                <div class="">
                    <button class="btn btn-dark" id="editButton">Ubah</button>
                    <button class="btn btn-success" id="saveButton" style="display:none;">Simpan</button>
                    <button class="btn btn-danger" id="cancelButton" style="display:none;">Batal</button>
                </div>
            </div>
            <form action="{{ route('kontak.update') }}" method="POST" id="contactForm">
                @csrf
                <div class="row">
                    <div class="col-lg-4 mb-3">
                        <label for="alamat">Alamat</label>
                        <textarea disabled name="alamat" id="alamat" rows="4"
                            class="form-control @error('alamat') is-invalid @enderror">{{ $kontak->alamat }}</textarea>
                        @error('alamat')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-lg-4 mb-3">
                        <label for="email">Email</label>
                        <input type="email" disabled name="email" id="email"
                            class="form-control @error('email') is-invalid @enderror" value="{{ $kontak->email }}">
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-lg-4 mb-3">
                        <label for="no_tlp">No Telepon</label>
                        <input type="text" disabled name="no_tlp" id="no_tlp"
                            class="form-control @error('no_tlp') is-invalid @enderror" value="{{ $kontak->no_tlp }}">
                        @error('no_tlp')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('js')
    <script>
        @if (session()->has('success'))
            Success.fire({
                text: "{{ session()->get('success') }}"
            })
        @endif
        @if (session()->has('fails'))
            Fails.fire({
                text: "{{ session()->get('fails') }}"
            })
        @endif
        document.addEventListener('DOMContentLoaded', function() {
            const editButton = document.getElementById('editButton');
            const saveButton = document.getElementById('saveButton');
            const cancelButton = document.getElementById('cancelButton');
            const inputs = document.querySelectorAll('#contactForm input, #contactForm textarea');

            editButton.addEventListener('click', function() {
                inputs.forEach(input => input.disabled = false);
                editButton.style.display = 'none';
                saveButton.style.display = 'inline-block';
                cancelButton.style.display = 'inline-block';
            });

            cancelButton.addEventListener('click', function() {
                inputs.forEach(input => {
                    input.disabled = true;
                    // Reset values if necessary
                    if (input.tagName.toLowerCase() === 'textarea') {
                        input.value = input.defaultValue;
                    } else {
                        input.value = input.defaultValue;
                    }
                });
                editButton.style.display = 'inline-block';
                saveButton.style.display = 'none';
                cancelButton.style.display = 'none';
            });

            saveButton.addEventListener('click', function() {
                // Optionally, you can handle form submission here.
                document.getElementById('contactForm').submit();
            });
        });
    </script>
@endpush
