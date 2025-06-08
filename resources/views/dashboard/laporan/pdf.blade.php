<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Peminjaman Armada - DriveEasy</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            background: #fff;
        }

        .header {
            text-align: center;
            padding: 20px 0;
            border-bottom: 3px solid #2563eb;
            margin-bottom: 30px;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        }

        .company-info {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
        }

        .logo {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            color: white;
            font-size: 24px;
            font-weight: bold;
        }

        .company-details h1 {
            font-size: 28px;
            color: #1e40af;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .company-details p {
            color: #6b7280;
            font-size: 14px;
        }

        .report-title {
            font-size: 24px;
            color: #1f2937;
            font-weight: bold;
            margin: 20px 0 10px 0;
        }

        .report-period {
            color: #6b7280;
            font-size: 14px;
            margin-bottom: 20px;
        }

        .summary-section {
            background: #f8fafc;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
            border-left: 4px solid #2563eb;
        }

        .summary-title {
            font-size: 18px;
            color: #1f2937;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .summary-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
        }

        .summary-item {
            text-align: center;
            padding: 15px;
            background: white;
            border-radius: 6px;
            border: 1px solid #e5e7eb;
        }

        .summary-item .value {
            font-size: 24px;
            font-weight: bold;
            color: #2563eb;
            margin-bottom: 5px;
        }

        .summary-item .label {
            font-size: 12px;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .table-container {
            overflow-x: auto;
            margin-bottom: 30px;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .data-table thead {
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            color: white;
        }

        .data-table th {
            padding: 15px 12px;
            text-align: left;
            font-weight: 600;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .data-table tbody tr:nth-child(even) {
            background: #f8fafc;
        }

        .data-table tbody tr:hover {
            background: #f1f5f9;
        }

        .data-table td {
            padding: 12px;
            border-bottom: 1px solid #e5e7eb;
            font-size: 14px;
        }

        .status-badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }        .status-pending {
            background: #fef3c7;
            color: #92400e;
        }

        .status-approved {
            background: #d1fae5;
            color: #065f46;
        }

        .status-rejected {
            background: #fee2e2;
            color: #991b1b;
        }

        .status-finished {
            background: #dbeafe;
            color: #1e40af;
        }

        .status-dipinjam {
            background: #f3e8ff;
            color: #7c3aed;
        }

        .currency {
            color: #059669;
            font-weight: 600;
        }

        .footer {
            margin-top: 50px;
            padding-top: 20px;
            border-top: 2px solid #e5e7eb;
            text-align: center;
            color: #6b7280;
            font-size: 12px;
        }

        .generated-info {
            background: #f3f4f6;
            padding: 15px;
            border-radius: 6px;
            margin-top: 20px;
            font-size: 12px;
            color: #4b5563;
        }

        .no-data {
            text-align: center;
            padding: 40px;
            color: #6b7280;
            font-style: italic;
        }

        @media print {
            .header {
                background: white !important;
            }
            
            .summary-section {
                background: #f9f9f9 !important;
            }

            .data-table tbody tr:nth-child(even) {
                background: #f9f9f9 !important;
            }
        }
    </style>
</head>
<body>
    <!-- Header Section -->
    <div class="header">
        <div class="company-info">
            <div class="logo">🚗</div>
            <div class="company-details">
                <h1>DriveEasy</h1>
                <p>Sistem Manajemen Rental Mobil</p>
            </div>
        </div>
        <div class="report-title">Laporan Peminjaman Armada</div>
        <div class="report-period">
            @if(request('start_date') || request('end_date'))
                Periode: 
                {{ request('start_date') ? \Carbon\Carbon::parse(request('start_date'))->format('d F Y') : 'Awal' }} 
                - 
                {{ request('end_date') ? \Carbon\Carbon::parse(request('end_date'))->format('d F Y') : 'Sekarang' }}
            @else
                Semua Data Peminjaman
            @endif
        </div>
    </div>

    <!-- Summary Statistics -->
    <div class="summary-section">
        <div class="summary-title">📊 Ringkasan Statistik</div>        <div class="summary-grid">
            <div class="summary-item">
                <div class="value">{{ $peminjamans->count() }}</div>
                <div class="label">Total Peminjaman</div>
            </div>
            <div class="summary-item">
                <div class="value">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</div>
                <div class="label">Total Pendapatan</div>
            </div>
            <div class="summary-item">
                <div class="value">{{ $peminjamans->where('status_pinjam', 'Approved')->count() }}</div>
                <div class="label">Disetujui</div>
            </div>
            <div class="summary-item">
                <div class="value">{{ $peminjamans->where('status_pinjam', 'Pending')->count() }}</div>
                <div class="label">Menunggu</div>
            </div>
        </div>
    </div>    <!-- Data Table -->
    <div class="table-container">
        @if($peminjamans->count() > 0)
            <table class="data-table">
                <thead>
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th style="width: 15%;">Peminjam</th>
                        <th style="width: 15%;">Armada</th>
                        <th style="width: 12%;">Tanggal Mulai</th>
                        <th style="width: 12%;">Tanggal Selesai</th>
                        <th style="width: 8%;">Durasi</th>
                        <th style="width: 15%;">Total Biaya</th>
                        <th style="width: 10%;">Status</th>
                        <th style="width: 8%;">Telepon</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($peminjamans as $index => $item)
                        <tr>
                            <td style="text-align: center; font-weight: 600;">{{ $index + 1 }}</td>
                            <td>
                                <div style="font-weight: 600; color: #1f2937;">{{ $item->nama_peminjam ?? 'N/A' }}</div>
                                <div style="font-size: 12px; color: #6b7280;">{{ $item->user->email ?? 'N/A' }}</div>
                            </td>
                            <td>
                                <div style="font-weight: 600; color: #1f2937;">{{ $item->armada->merk ?? 'N/A' }}</div>
                                <div style="font-size: 12px; color: #6b7280;">{{ $item->armada->nopol ?? 'N/A' }}</div>
                            </td>
                            <td>{{ $item->mulai ? $item->mulai->format('d/m/Y') : 'N/A' }}</td>
                            <td>{{ $item->selesai ? $item->selesai->format('d/m/Y') : 'N/A' }}</td>
                            <td style="text-align: center;">
                                @if($item->mulai && $item->selesai)
                                    {{ $item->mulai->diffInDays($item->selesai) + 1 }} hari
                                @else
                                    N/A
                                @endif
                            </td>
                            <td class="currency">Rp {{ number_format($item->biaya ?? 0, 0, ',', '.') }}</td>
                            <td>
                                <span class="status-badge status-{{ strtolower($item->status_pinjam ?? 'pending') }}">
                                    {{ $item->status_pinjam ?? 'Pending' }}
                                </span>
                            </td>
                            <td style="font-size: 12px;">{{ $item->phone ?? '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="no-data">
                <p>📝 Tidak ada data peminjaman untuk periode yang dipilih</p>
            </div>
        @endif
    </div>    <!-- Generated Info -->
    <div class="generated-info">
        <strong>📅 Informasi Laporan:</strong><br>
        • Laporan ini dibuat secara otomatis oleh sistem DriveEasy<br>
        • Tanggal pembuatan: {{ now()->format('d F Y, H:i:s') }} WIB<br>
        • Total data yang ditampilkan: {{ $peminjamans->count() }} record<br>
        • Filter yang diterapkan: 
        @if(request('status'))
            Status = {{ ucfirst(request('status')) }}
        @endif
        @if(request('armada_id'))
            , Armada = {{ \App\Models\Armada::find(request('armada_id'))->merk ?? 'Unknown' }}
        @endif
        @if(!request('status') && !request('armada_id'))
            Tidak ada filter khusus
        @endif
    </div>

    <!-- Footer -->
    <div class="footer">
        <p><strong>DriveEasy - Sistem Manajemen Rental Mobil</strong></p>
        <p>Dokumen ini dibuat secara otomatis dan tidak memerlukan tanda tangan</p>
        <p>© {{ date('Y') }} DriveEasy. Semua hak dilindungi undang-undang.</p>
    </div>
</body>
</html>
