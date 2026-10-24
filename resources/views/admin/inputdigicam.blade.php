
<x-admin-layout>
    <style>
        .form-page {
            max-width: 850px;
            margin: 0 auto;
        }

        .form-header {
            margin-bottom: 25px;
        }

        .form-header h2 {
            font-size: 26px;
            font-weight: 700;
            color: #172b4d;
            margin: 0 0 8px;
        }

        .form-header p {
            color: #64748b;
            font-size: 14px;
            margin: 0;
        }

        .form-card {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 28px;
            box-shadow: 0 4px 15px rgba(15, 23, 42, 0.04);
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 22px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .form-group.full {
            grid-column: 1 / -1;
        }

        .form-group label {
            font-size: 14px;
            font-weight: 600;
            color: #374151;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #d1d5db;
            border-radius: 7px;
            background: #fff;
            color: #1f2937;
            font: inherit;
            font-size: 14px;
            outline: none;
        }

        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            border-color: #4263eb;
            box-shadow: 0 0 0 3px rgba(66, 99, 235, 0.12);
        }

        .form-group textarea {
            min-height: 110px;
            resize: vertical;
        }

        .form-error {
            color: #dc2626;
            font-size: 12px;
        }

        .form-footer {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 28px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
        }

        .form-btn {
            padding: 11px 20px;
            border-radius: 7px;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            border: none;
        }

        .form-btn-cancel {
            color: #475569;
            background: #f1f5f9;
        }

        .form-btn-save {
            color: white;
            background: #4263eb;
        }

        .form-btn:hover {
            opacity: 0.9;
        }

        @media (max-width: 650px) {
            .form-card {
                padding: 18px;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .form-group.full {
                grid-column: auto;
            }
        }
    </style>

    <div class="form-page">
        <div class="form-header">
            <h2>{{ $title }}</h2>
            <p>Lengkapi informasi kamera digital yang akan disimpan.</p>
        </div>

        <div class="form-card">
            <form
                action="{{ isset($digicam) ? route('digicam.update', $digicam->id_digicam) : route('digicam.store') }}"
                method="POST"
            >
                @csrf

                @if (isset($digicam))
                    @method('PUT')
                @endif

                <div class="form-grid">
                    <div class="form-group">
                        <label for="nama">Nama Digicam</label>
                        <input
                            id="nama"
                            type="text"
                            name="nama"
                            value="{{ old('nama', $digicam->nama ?? '') }}"
                            placeholder="Contoh: Canon PowerShot G7 X"
                            required
                        >
                        @error('nama')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="merek">Merek</label>
                        <input
                            id="merek"
                            type="text"
                            name="merek"
                            value="{{ old('merek', $digicam->merek ?? '') }}"
                            placeholder="Contoh: Canon"
                            required
                        >
                        @error('merek')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="harga">Harga (Rp)</label>
                        <input
                            id="harga"
                            type="number"
                            name="harga"
                            min="0"
                            value="{{ old('harga', $digicam->harga ?? '') }}"
                            placeholder="Contoh: 7500000"
                            required
                        >
                        @error('harga')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="stok">Stok (unit)</label>
                        <input
                            id="stok"
                            type="number"
                            name="stok"
                            min="0"
                            value="{{ old('stok', $digicam->stok ?? '') }}"
                            placeholder="Jumlah stok"
                            required
                        >
                        @error('stok')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group full">
                        <label for="id_kategori">Kategori Kamera</label>
                        <select id="id_kategori" name="id_kategori">
                            <option value="">Pilih kategori</option>

                            @foreach ($kategoris as $kategori)
                                <option
                                    value="{{ $kategori->id_kategori }}"
                                    {{ old('id_kategori', $digicam->id_kategori ?? '') == $kategori->id_kategori ? 'selected' : '' }}
                                >
                                    {{ $kategori->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_kategori')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group full">
                        <label for="deskripsi">Deskripsi Produk</label>
                        <textarea
                            id="deskripsi"
                            name="deskripsi"
                            placeholder="Jelaskan kondisi atau spesifikasi kamera..."
                        >{{ old('deskripsi', $digicam->deskripsi ?? '') }}</textarea>
                        @error('deskripsi')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-footer">
                    <a
                        href="{{ route('digicam.index') }}"
                        class="form-btn form-btn-cancel"
                    >
                        Batal
                    </a>

                    <button type="submit" class="form-btn form-btn-save">
                        {{ isset($digicam) ? 'Simpan Perubahan' : 'Simpan Digicam' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
