<div class="position-static bg-white w-100" style="height: 60px; color: var(--dark) !important">
    <div class="d-flex align-items-center px-3 w-100 h-100" style="gap:.5rem">
        <span id="sidebar-toggle" class="text-secondary admin-navbar-item">
            <i class="fa-solid fa-chevron-left fa-lg" style="transition: transform 500ms cubic-bezier(1,0,0,1)"></i>
        </span>
        <h5 class="m-0">
            {{ $title }}
        </h5>
        <span id="logoutBtn" class="text-danger admin-navbar-item ml-auto" onclick="logout()">
            <i class="fa-solid fa-right-from-bracket fa-lg" style="transition: transform 500ms cubic-bezier(1,0,0,1)"></i>
        </span>
    </div>
</div>
@push('js')
    <script>
        function logout() {
            Question.fire({
                text: "Apakah anda yakin ingin logout?",
                confirmButtonText: 'Ya, lanjutkan!',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `/admin/logout`;
                    document.body.appendChild(form);

                    // Menambahkan input tersembunyi untuk menyimpan token CSRF
                    const csrfInput = document.createElement('input');
                    csrfInput.type = 'hidden';
                    csrfInput.name = '_token';
                    csrfInput.value = csrfToken;
                    form.appendChild(csrfInput);
                    form.submit();
                }
            })
        }
    </script>
@endpush
