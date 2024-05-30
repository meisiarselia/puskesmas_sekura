@extends('layouts.app')

@section('main')
    @push('css')
        <style>
            .grid {
                margin: 0 auto;
            }

            .grid-item {
                transition: 50ms !important;
                width: 200px;
                margin-bottom: 15px;
            }

            .grid-item img {
                width: 100%;
                display: block;
            }

            .grid-item:hover {
                transform: scale(1.1);
                z-index: 2;
            }
        </style>
    @endpush
    @include('layouts.header', [
        'title' => 'Penghargaan & Prestasi',
        'breads' => [['Beranda', '/'], ['All']],
    ])
    <section class="gray-bg">
        <div class="container">
            <div class="grid">
            </div>
        </div>
    </section>
    @push('js')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/masonry/4.2.2/masonry.pkgd.min.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const container = document.querySelector('.container');
                const grid = document.querySelector('.grid');
                const msnry = new Masonry(grid, {
                    itemSelector: '.grid-item',
                    gutter: 15,
                    fitWidth: true,
                });
                const imageInfos = [
                    @foreach ($prestasis as $prestasi)
                        {
                            url: "{{ $prestasi->nama_gambar }}",
                            caption: "{{ $prestasi->nama_prestasi }}"
                        },
                    @endforeach
                ];
                let imagesLoaded = 0;
                imageInfos.forEach(function(info) {
                    const img = new Image();
                    img.onload = function() {
                        const gridItem = document.createElement('div');
                        gridItem.className = 'grid-item shadow-lg bg-whites rounded overflow-hidden';
                        gridItem.innerHTML = '<img class="rounded" src="' + info.url +
                            '"><div class="text-center px-2 py-3 bg-white" style="color: black; line-height:1rem">' +
                            info
                            .caption + '</div>';
                        grid.appendChild(gridItem);
                        msnry.appended(gridItem);
                        imagesLoaded++;
                        if (imagesLoaded === imageInfos.length) {
                            msnry.layout();
                        }
                    };
                    img.src = info.url;
                });
            });
        </script>
    @endpush
@endsection
