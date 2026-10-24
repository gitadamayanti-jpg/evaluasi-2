<x-admin-layout>

    <style>
        .digicam-page h2 {
            font-size: 24px;
            font-weight: 700;
            color: #172b4d;
            margin: 0 0 22px;
        }

        .digicam-card {
            background: #fff;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 3px 12px rgba(23, 43, 77, .06);
            overflow-x: auto;
        }

        .digicam-toolbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 22px;
        }

        .digicam-search {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .digicam-page button,
        .digicam-page input {
            font: inherit;
        }

        .digicam-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 40px;
            padding: 9px 15px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            background: #fff;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            transition: background .2s, color .2s, border-color .2s;
            box-sizing: border-box;
        }

        .digicam-btn-add {
            color: #fff;
            background: #4361ee;
            border-color: #4361ee;
        }

        .digicam-btn-add:hover {
            background: #3048c5;
            border-color: #3048c5;
        }

        .digicam-search input {
            width: 240px;
            max-width: 100%;
            padding: 10px 12px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            outline: none;
        }

        .digicam-search input:focus {
            border-color: #4361ee;
            box-shadow: 0 0 0 3px rgba(67, 97, 238, .12);
        }

        .digicam-search button {
            color: #374151;
        }

        .digicam-search button:hover {
            background: #f3f4f6;
        }

        .digicam-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 700px;
        }

        .digicam-table th {
            background: #f8fafc;
            color: #64748b;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: .04em;
        }

        .digicam-table th,
        .digicam-table td {
            padding: 16px 12px;
            border-bottom: 1px solid #e5e7eb;
            text-align: left;
            vertical-align: middle;
        }

        .digicam-table tbody tr:hover {
            background: #fafbff;
        }

        .digicam-product {
            display: flex;
            align-items: center;
            gap: 14px;
            min-width: 280px;
        }

        .digicam-photo {
            width: 64px;
            height: 64px;
            border-radius: 9px;
            background: #eef1f6;
            color: #374151;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            flex-shrink: 0;
            object-fit: cover;
        }

        .digicam-name {
            color: #172b4d;
            font-weight: 700;
        }

        .digicam-muted {
            color: #64748b;
            font-size: 13px;
            line-height: 1.5;
            margin-top: 5px;
            max-width: 430px;
        }

        .digicam-price {
            font-weight: 700;
            color: #172b4d;
            white-space: nowrap;
        }

        .digicam-stock {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 7px;
            background: #eef2ff;
            color: #4361ee;
            font-size: 12px;
            font-weight: 600;
            white-space: nowrap;
        }

        /* Tombol Edit dan Hapus */
        .digicam-action-buttons {
            display: flex;
            align-items: center;
            gap: 8px;
            white-space: nowrap;
        }

        .digicam-action-buttons form {
            margin: 0;
        }

        .digicam-btn-edit {
            min-width: 76px;
            color: #fff;
            background: #4361ee;
            border-color: #4361ee;
        }

        .digicam-btn-edit:hover {
            color: #fff;
            background: #3048c5;
            border-color: #3048c5;
        }

        .digicam-btn-delete {
            min-width: 76px;
            color: #dc3545;
            background: #fff;
            border-color: #f0a4aa;
        }

        .digicam-btn-delete:hover {
            color: #fff;
            background: #dc3545;
            border-color: #dc3545;
        }

        .digicam-empty {
            text-align: center !important;
            color: #64748b;
            padding: 30px !important;
        }

        .digicam-alert {
            background: #ecfdf5;
            border: 1px solid #a7f3d0;
            color: #047857;
            border-radius: 8px;
            padding: 12px 16px;
            margin-bottom: 18px;
        }

        @media (max-width: 600px) {
            .digicam-card {
                padding: 14px;
            }

            .digicam-toolbar {
                align-items: stretch;
            }

            .digicam-search input {
                width: 150px;
            }

            .digicam-search {
                flex-wrap: wrap;
            }
        }
    </style>

    <div class="digicam-page">

        <h2>{{ $title }}</h2>

        @if (session('success'))
            <div class="digicam-alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="digicam-card">

            <div class="digicam-toolbar">

                <a href="{{ route('digicam.create') }}"
                   class="digicam-btn digicam-btn-add">
                    + Tambah Digicam
                </a>

                <form class="digicam-search"
                      method="GET"
                      action="{{ route('digicam.index') }}">

                    <input type="text"
                           name="cari"
                           value="{{ request('cari') }}"
                           placeholder="Cari digicam...">

                    <button type="submit" class="digicam-btn">
                        Cari
                    </button>
                </form>

            </div>

            <table class="digicam-table">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Merek</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($digicam as $item)
                        <tr>
                            <td>
                                <div class="digicam-product">

                                    @if (!empty($item->foto))
                                        <img
                                            class="digicam-photo"
                                            src="{{ asset($item->foto) }}"
                                            alt="{{ $item->nama }}"
                                            onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                                        >
                                    @endif

                                    <div class="digicam-photo"
                                         @if (!empty($item->foto))
                                             style="display:none"
                                         @endif>
                                        CAM
                                    </div>

                                    <div>
                                        <div class="digicam-name">
                                            {{ $item->nama }}
                                        </div>

                                        <div class="digicam-muted">
                                            {{ $item->deskripsi }}
                                        </div>
                                    </div>

                                </div>
                            </td>

                            <td>{{ $item->merek }}</td>

                            <td class="digicam-price">
                                Rp {{ number_format($item->harga, 0, ',', '.') }}
                            </td>

                            <td>
                                <span class="digicam-stock">
                                    {{ $item->stok }} unit
                                </span>
                            </td>

                            <td>
                                <div class="digicam-action-buttons">

                                    <a
                                        href="{{ route('digicam.edit', $item->id) }}"
                                        class="digicam-btn digicam-btn-edit">
                                        Edit
                                    </a>

                                    <form
                                        action="{{ route('digicam.destroy', $item->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus digicam ini?')">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="digicam-btn digicam-btn-delete">
                                            Hapus
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="5" class="digicam-empty">
                                Belum ada produk digicam.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div style="margin-top: 18px;">
                {{ $digicam->links() }}
            </div>

        </div>
    </div>

</x-admin-layout>