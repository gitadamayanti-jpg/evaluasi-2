<x-home-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <main class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

                        {{-- JUDUL HALAMAN --}}
                        <div class="flex flex-wrap items-center justify-between gap-4 border-b border-gray-200 pt-2 pb-6">
                            <h1 class="text-3xl font-bold tracking-tight text-gray-900">
                                Koleksi Kamera REPLAY
                            </h1>

                            <a href="{{ route('digicam.index') }}"
                               class="inline-flex items-center px-4 py-2 border border-blue-600 text-blue-600 text-sm font-medium rounded-md hover:bg-blue-50">
                                Admin
                            </a>
                        </div>

                        {{-- SEARCH DAN FILTER KATEGORI --}}
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mt-6">

                            {{-- SEARCH DI KIRI --}}
                            <form action="{{ url('/') }}" method="GET"
                                  class="flex items-center gap-2 w-full md:max-w-md">

                                <input
                                    type="text"
                                    name="cari"
                                    value="{{ request('cari') }}"
                                    placeholder="Cari nama atau merek kamera..."
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                >

                                @if(request()->filled('id_kategori'))
                                    <input type="hidden"
                                           name="id_kategori"
                                           value="{{ request('id_kategori') }}">
                                @endif

                                <button type="submit"
                                        class="px-5 py-2.5 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700">
                                    Cari
                                </button>
                            </form>

                            {{-- KATEGORI DI KANAN --}}
                            <form action="{{ url('/') }}" method="GET"
                                  class="flex items-center gap-3">

                                @if(request()->filled('cari'))
                                    <input type="hidden"
                                           name="cari"
                                           value="{{ request('cari') }}">
                                @endif

                                <label for="id_kategori"
                                       class="text-sm font-medium text-gray-700 whitespace-nowrap">
                                    Kategori:
                                </label>

                                <select
                                    name="id_kategori"
                                    id="id_kategori"
                                    onchange="this.form.submit()"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5">

                                    <option value="">Semua Kategori</option>

                                    @foreach($kategoris as $kategori)
                                        <option
                                            value="{{ $kategori->id_kategori }}"
                                            {{ request('id_kategori') == $kategori->id_kategori ? 'selected' : '' }}>
                                            {{ $kategori->nama_kategori }}
                                        </option>
                                    @endforeach
                                </select>
                            </form>

                        </div>

                        {{-- DAFTAR KAMERA --}}
                        <section class="mt-4">

                            @forelse($digicam as $item)

                                <div class="md:flex font-sans pt-8">

                                    {{-- GAMBAR KAMERA --}}
                                    <div class="md:shrink-0">

                                        @if(!empty($item->foto))
                                            <img
                                                src="{{ asset('storage/' . $item->foto) }}"
                                                alt="{{ $item->nama }}"
                                                class="h-48 w-full md:h-56 md:w-56 object-cover rounded-lg"
                                            >
                                        @else
                                            <div class="h-48 w-full md:h-56 md:w-56 flex items-center justify-center bg-blue-50 rounded-lg">
                                                <span class="text-gray-400">
                                                    Tidak ada gambar
                                                </span>
                                            </div>
                                        @endif

                                    </div>

                                    {{-- INFORMASI KAMERA --}}
                                    <div class="p-6 flex-1">

                                        <div class="flex flex-wrap items-start justify-between gap-2">

                                            <h2 class="flex-auto font-semibold text-lg text-slate-900">
                                                {{ $item->nama }}
                                            </h2>

                                            <span class="text-sm font-medium text-blue-600">
                                                {{ $item->merek }}
                                            </span>

                                        </div>

                                        <div class="w-full mt-3 text-sm text-gray-600">
                                            Kategori:
                                            {{ $item->kategori->nama_kategori ?? 'Belum ada kategori' }}
                                        </div>

                                        <div class="mt-3 text-xl font-bold text-blue-600">
                                            Rp {{ number_format($item->harga ?? 0, 0, ',', '.') }}
                                        </div>

                                        <div class="mt-2 text-sm font-medium text-gray-500">
                                            Stok tersedia: {{ $item->stok ?? 0 }}
                                        </div>

                                        <div class="mt-4 mb-4 pb-4 border-b border-slate-200 text-sm leading-6 text-gray-600">
                                            {{ $item->deskripsi ?: 'Informasi kamera belum tersedia.' }}
                                        </div>

                                    </div>

                                </div>

                            @empty

                                <div class="py-12 text-center">
                                    <h2 class="text-xl font-semibold text-gray-700">
                                        Kamera Belum Tersedia
                                    </h2>

                                    <p class="mt-2 text-gray-500">
                                        Belum ada kamera yang sesuai dengan pencarian atau kategori yang dipilih.
                                    </p>
                                </div>

                            @endforelse

                            {{-- PAGINATION --}}
                            <div class="font-sans pt-8 text-center">
                                @if(method_exists($digicam, 'links'))
                                    {{ $digicam->withQueryString()->links() }}
                                @endif
                            </div>

                        </section>

                    </main>

                </div>
            </div>
        </div>
    </div>

    {{-- FOOTER --}}
    <footer class="py-5 text-center text-sm text-gray-500">
        © 2026 REPLAY. All rights reserved.
    </footer>

</x-home-layout>