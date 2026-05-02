@extends('layouts.app')
@section('title', 'Laporan Dana Keluar')
@section('content')
<style>
.report-container{background:white;border-radius:16px;box-shadow:0 5px 25px rgba(0,0,0,.08);padding:2.5rem;max-width:1200px;margin:0 auto}
.report-header{text-align:center;margin-bottom:2rem;padding-bottom:1.5rem;border-bottom:3px solid #A0522D}
.school-logo{width:80px;height:80px;margin:0 auto 1rem}
.school-name{font-size:1.8rem;font-weight:700;color:#5D4037;margin-bottom:.5rem;text-transform:uppercase;letter-spacing:1px}
.report-title{font-size:1.3rem;font-weight:600;color:#A0522D;margin-bottom:.5rem}
.report-period{font-size:1rem;color:#6D4C41;font-weight:500}
.filter-section{background:linear-gradient(135deg,#FFF0F0,#FFE4E4);padding:1.5rem;border-radius:12px;margin-bottom:2rem;border-left:4px solid #A0522D}
.filter-title{font-weight:700;color:#A0522D;margin-bottom:1rem;display:flex;align-items:center;gap:.5rem}
.form-control,.form-select{border:2px solid #FFDDDD;border-radius:8px;padding:.6rem 1rem;font-size:14px}
.form-control:focus,.form-select:focus{border-color:#A0522D;box-shadow:0 0 0 .2rem rgba(160,82,45,.15);outline:none}
.btn-filter{background:linear-gradient(135deg,#A0522D,#D2691E);border:none;padding:.6rem 1.5rem;border-radius:8px;color:white;font-weight:600;transition:all .3s}
.btn-filter:hover{transform:translateY(-2px);box-shadow:0 4px 12px rgba(160,82,45,.4);color:white}
.btn-print{background:white;border:2px solid #A0522D;padding:.6rem 1.5rem;border-radius:8px;color:#A0522D;font-weight:600;transition:all .3s;text-decoration:none;display:inline-flex;align-items:center}
.btn-print:hover{background:#A0522D;color:white}
.table-report{font-size:14px;margin-bottom:0}
.table-report thead{background:linear-gradient(135deg,#A0522D,#D2691E);color:white}
.table-report thead th{padding:1rem .75rem;font-weight:600;text-transform:uppercase;font-size:12px;letter-spacing:.5px;border:none;vertical-align:middle}
.table-report tbody td{padding:.9rem .75rem;vertical-align:middle;border-color:#F5F5F5}
.table-report tbody tr{transition:all .3s}
.table-report tbody tr:hover{background:#FFF8F0}
.table-report tfoot{background:linear-gradient(135deg,#FFF0F0,#FFE4E4);font-weight:700}
.table-report tfoot td{padding:1rem .75rem;color:#A0522D;font-size:15px;border-top:3px solid #A0522D}
.no-cell{background:linear-gradient(135deg,#A0522D,#D2691E);color:white;font-weight:700;border-radius:6px;width:32px;height:32px;display:inline-flex;align-items:center;justify-content:center;font-size:13px}
.jenis-badge{background:#FFF0F0;color:#A0522D;padding:.3rem .7rem;border-radius:6px;font-weight:600;border:1px solid #FFDDDD;display:inline-block;font-size:12px}
.badge-biaya{background:#E3F2FD;color:#1565C0;padding:.2rem .5rem;border-radius:4px;font-size:11px;font-weight:600;display:inline-block;margin-bottom:3px}
.badge-atk{background:#E8F5E9;color:#2E7D32;padding:.2rem .5rem;border-radius:4px;font-size:11px;font-weight:600;display:inline-block;margin-bottom:3px}
.badge-gaji{background:#FFF3E0;color:#E65100;padding:.2rem .5rem;border-radius:4px;font-size:11px;font-weight:600;display:inline-block;margin-bottom:3px}
.amount-text{font-weight:700;color:#5D4037}
.empty-state{padding:3rem;text-align:center}
.empty-state i{font-size:3.5rem;color:#BDBDBD;margin-bottom:1rem}
.empty-state p{color:#9E9E9E;font-weight:500}
.btn-detail-modal{background:linear-gradient(135deg,#17a2b8,#20c997);color:white;padding:.35rem .85rem;border-radius:7px;border:none;font-size:12px;font-weight:600;transition:all .3s;cursor:pointer;display:inline-flex;align-items:center;gap:.3rem}
.btn-detail-modal:hover{transform:translateY(-2px);box-shadow:0 4px 12px rgba(23,162,184,.4);color:white}
/* MODAL */
.modal-overlay{display:none;position:fixed;inset:0;background:rgba(0,0,0,.6);z-index:9999;align-items:center;justify-content:center;padding:1rem}
.modal-overlay.active{display:flex}
.modal-box{background:white;border-radius:16px;box-shadow:0 20px 60px rgba(0,0,0,.3);width:100%;max-width:640px;max-height:90vh;overflow-y:auto;animation:mIn .25s ease}
.modal-box-lg{max-width:800px}
@keyframes mIn{from{opacity:0;transform:scale(.95)}to{opacity:1;transform:scale(1)}}
.modal-head{background:linear-gradient(135deg,#A0522D,#D2691E);color:white;padding:1.25rem 1.5rem;border-radius:16px 16px 0 0;display:flex;justify-content:space-between;align-items:center}
.modal-head h5{margin:0;font-weight:700;font-size:1rem}
.btn-close-modal{background:none;border:none;color:white;font-size:1.5rem;cursor:pointer;line-height:1;opacity:.8;transition:opacity .2s}
.btn-close-modal:hover{opacity:1}
.modal-body-pad{padding:1.5rem}
.modal-row{display:flex;border-bottom:1px solid #F5EDE3;padding:.7rem 0}
.modal-row:last-child{border-bottom:none}
.modal-lbl{width:170px;min-width:170px;font-weight:600;color:#8B4513;font-size:13px;display:flex;align-items:flex-start;gap:.4rem;padding-top:2px}
.modal-val{flex:1;color:#5D4037;font-size:14px;font-weight:500}
.modal-sec{font-weight:700;color:#8B4513;font-size:13px;padding:.5rem 0 .25rem;border-bottom:2px solid #F5E6D3;margin-bottom:.5rem;display:flex;align-items:center;gap:.4rem}
.modal-amount{font-weight:700;color:#8B6914;font-size:17px}
.modal-kode{font-family:monospace;background:#FFF8F0;border:1px solid #E0D5C7;color:#8B4513;padding:.2rem .5rem;border-radius:5px;font-weight:700}
.modal-empty{color:#BCAAA4;font-style:italic;font-size:13px}
.modal-table{width:100%;border-collapse:collapse;font-size:13px;margin-top:.5rem}
.modal-table thead{background:linear-gradient(135deg,#A0522D,#D2691E);color:white}
.modal-table th,.modal-table td{padding:.6rem .75rem;border:1px solid #F0E6D3}
.modal-table tbody tr:hover{background:#FFF8F0}
.btn-rincian{background:linear-gradient(135deg,#8B4513,#D2691E);color:white;padding:.3rem .7rem;border-radius:6px;border:none;font-size:12px;font-weight:600;text-decoration:none;display:inline-flex;align-items:center;gap:.3rem;transition:all .3s}
.btn-rincian:hover{transform:translateY(-1px);box-shadow:0 3px 10px rgba(139,69,19,.4);color:white}
.img-zoom-overlay{display:none;position:fixed;inset:0;background:rgba(0,0,0,.88);z-index:10999;align-items:center;justify-content:center;cursor:zoom-out}
.img-zoom-overlay.active{display:flex}
.img-zoom-overlay img{max-width:90vw;max-height:90vh;border-radius:10px}
@media print{
  .filter-section,.no-print{display:none!important}
  .report-container{box-shadow:none;padding:1rem}
  .table-report{font-size:12px}
  .modal-overlay{display:none!important}
}
</style>

<div class="report-container">
  {{-- HEADER --}}
  <div class="report-header">
    <div class="school-logo">
      <img src="{{ asset('images/logo/logo_sekolah.png') }}" alt="Logo" style="width:100%;height:100%;object-fit:contain">
    </div>
    <div class="school-name">MTs Mulia Insani</div>
    <div class="report-title">Laporan Dana Keluar / Pengeluaran Kas</div>
    <div class="report-period">
      Periode:
      @if(request('bulan') && request('tahun'))
        {{ \Carbon\Carbon::create(request('tahun'), request('bulan'))->translatedFormat('F Y') }}
      @elseif(request('tahun'))
        Tahun {{ request('tahun') }}
      @else
        Semua Periode
      @endif
    </div>
  </div>

  {{-- FILTER --}}
  <div class="filter-section no-print">
    <div class="filter-title"><i class="bi bi-funnel-fill"></i> Filter Laporan</div>
    <form method="GET" action="{{ route('laporan.kas_keluar') }}">
      <div class="row g-3">
        <div class="col-md-4">
          <label class="form-label fw-semibold" style="color:#5D4037;font-size:13px;">
            <i class="bi bi-calendar-month me-1"></i>Bulan
          </label>
          <select name="bulan" class="form-select">
            <option value="">Semua Bulan</option>
            @for($i=1;$i<=12;$i++)
              <option value="{{ $i }}" {{ request('bulan')==$i?'selected':'' }}>
                {{ \Carbon\Carbon::create()->month($i)->translatedFormat('F') }}
              </option>
            @endfor
          </select>
        </div>
        <div class="col-md-4">
          <label class="form-label fw-semibold" style="color:#5D4037;font-size:13px;">
            <i class="bi bi-calendar me-1"></i>Tahun
          </label>
          <select name="tahun" class="form-select">
            <option value="">Semua Tahun</option>
            @for($y=date('Y');$y>=date('Y')-5;$y--)
              <option value="{{ $y }}" {{ request('tahun')==$y?'selected':'' }}>{{ $y }}</option>
            @endfor
          </select>
        </div>
        <div class="col-md-4">
          <label class="form-label" style="opacity:0">.</label>
          <div class="d-flex gap-2">
            <button type="submit" class="btn btn-filter flex-fill">
              <i class="bi bi-search me-1"></i>Tampilkan
            </button>
            <a href="{{ route('laporan.kas_keluar') }}" class="btn-print" title="Reset">
              <i class="bi bi-arrow-clockwise"></i>
            </a>
            <button type="button" onclick="window.print()" class="btn-print" title="Cetak">
              <i class="bi bi-printer"></i>
            </button>
          </div>
        </div>
      </div>
    </form>
  </div>

  {{-- TABLE --}}
  <div class="table-responsive">
    <table class="table table-report table-bordered">
      <thead>
        <tr>
          <th width="4%" class="text-center">No</th>
          <th width="14%">Tanggal / Periode</th>
          <th width="18%">Jenis Pengeluaran</th>
          <th width="34%">Nama / Keterangan</th>
          <th width="18%" class="text-end">Jumlah</th>
          <th width="12%" class="text-center no-print">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($kasKeluar as $item)
        <tr>
          <td class="text-center"><span class="no-cell">{{ $loop->iteration }}</span></td>
          <td>
            <i class="bi bi-calendar3 me-1" style="color:#A0522D"></i>
            @if($item['source'] === 'gaji_guru_group')
              {{ $item['tanggal'] }}
            @else
              {{ \Carbon\Carbon::parse($item['tanggal'])->translatedFormat('d F Y') }}
            @endif
          </td>
          <td>
            @if($item['source'] === 'biaya_operasional')
              <span class="badge-biaya"><i class="bi bi-receipt me-1"></i>Biaya Ops</span><br>
            @elseif($item['source'] === 'pembelian_atk')
              <span class="badge-atk"><i class="bi bi-basket me-1"></i>ATK</span><br>
            @else
              <span class="badge-gaji"><i class="bi bi-person-badge me-1"></i>Gaji Guru</span><br>
            @endif
            <span class="jenis-badge">{{ $item['jenis_pengeluaran'] }}</span>
          </td>
          <td>
            {{ $item['nama_pengeluaran'] }}
            @if($item['source'] === 'gaji_guru_group')
              <span class="text-muted" style="font-size:12px">
                &nbsp;({{ $item['jumlah_guru'] }} Guru)
              </span>
            @endif
          </td>
          <td class="text-end amount-text">
            Rp {{ number_format($item['jumlah'], 0, ',', '.') }}
          </td>
          <td class="text-center no-print">
            <button class="btn-detail-modal" onclick="bukaModal({{ $loop->index }})" title="Lihat Detail">
              <i class="bi bi-eye"></i> Detail
            </button>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="6" class="empty-state">
            <i class="bi bi-inbox"></i>
            <p class="mb-0">Tidak ada data pengeluaran kas untuk periode ini</p>
          </td>
        </tr>
        @endforelse
      </tbody>
      @if($kasKeluar->count() > 0)
      <tfoot>
        <tr>
          <td colspan="4" class="text-end">
            <i class="bi bi-calculator me-2"></i>TOTAL DANA KELUAR
          </td>
          <td class="text-end">Rp {{ number_format($total, 0, ',', '.') }}</td>
          <td class="no-print"></td>
        </tr>
      </tfoot>
      @endif
    </table>
  </div>

  {{-- TANDA TANGAN (print only) --}}
  <div style="margin-top:3rem;display:none" class="d-print-block">
    <div class="row">
      <div class="col-6 text-center">
        <p style="margin-bottom:4rem">Mengetahui,<br>Kepala Sekolah</p>
        <p style="border-bottom:2px solid #000;display:inline-block;padding:0 3rem">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
        <p>NIP. _______________</p>
      </div>
      <div class="col-6 text-center">
        <p style="margin-bottom:4rem">
          {{ request('tahun') ?: date('Y') }}, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}<br>Bendahara
        </p>
        <p style="border-bottom:2px solid #000;display:inline-block;padding:0 3rem">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
        <p>NIP. _______________</p>
      </div>
    </div>
  </div>
</div>

{{-- ==============================
     MODAL DETAIL BIAYA OPS / ATK
     ============================== --}}
<div class="modal-overlay" id="modalDetailOverlay" onclick="tutupModalLuar(event,'modalDetailOverlay')">
  <div class="modal-box" id="modalDetailBox">
    <div class="modal-head">
      <h5 id="modalDetailJudul"><i class="bi bi-info-circle me-2"></i>Detail Transaksi</h5>
      <button class="btn-close-modal" onclick="tutupModal('modalDetailOverlay')">&times;</button>
    </div>
    <div class="modal-body-pad" id="modalDetailBody"></div>
  </div>
</div>

{{-- ==============================
     MODAL LIST GAJI GURU
     ============================== --}}
<div class="modal-overlay" id="modalGajiOverlay" onclick="tutupModalLuar(event,'modalGajiOverlay')">
  <div class="modal-box modal-box-lg" id="modalGajiBox">
    <div class="modal-head">
      <h5 id="modalGajiJudul"><i class="bi bi-people me-2"></i>Daftar Gaji Guru</h5>
      <button class="btn-close-modal" onclick="tutupModal('modalGajiOverlay')">&times;</button>
    </div>
    <div class="modal-body-pad" id="modalGajiBody"></div>
  </div>
</div>

{{-- Image zoom --}}
<div class="img-zoom-overlay" id="imgZoomOverlay" onclick="document.getElementById('imgZoomOverlay').classList.remove('active')">
  <img id="imgZoomSrc" src="" alt="Bukti">
</div>

{{-- DATA JSON --}}
<script>
const kasKeluarData = @json($kasKeluar->values()->toArray());
const gajiGuruDetails = @json($gajiGuruDetails);

function bukaModal(index) {
  const item = kasKeluarData[index];
  if (item.source === 'gaji_guru_group') {
    bukaModalGaji(item);
  } else {
    bukaModalDetail(item);
  }
}

/* ---------- MODAL DETAIL (biaya ops / ATK) ---------- */
function bukaModalDetail(item) {
  let html = '';
  if (item.source === 'biaya_operasional') {
    document.getElementById('modalDetailJudul').innerHTML = '<i class="bi bi-receipt me-2"></i>Detail Biaya Operasional';
    html += mRow('bi-upc-scan','Kode Transaksi','<span class="modal-kode">'+(item.kode_transaksi||'-')+'</span>');
    html += mRow('bi-calendar3','Tanggal',fTgl(item.tanggal));
    html += mRow('bi-file-text','Nomor Nota', item.nomor_nota||'<span class="modal-empty">Tidak ada</span>');
    html += mRow('bi-tag','Jenis Pengeluaran','<span class="jenis-badge">'+item.jenis_pengeluaran+'</span>');
    html += mRow('bi-chat-left-text','Keterangan', item.keterangan||'<span class="modal-empty">Tidak ada</span>');
    html += mRow('bi-cash','Total','<span class="modal-amount">Rp '+fRp(item.jumlah)+'</span>');
    if (item.bukti) {
      html += '<div class="modal-sec"><i class="bi bi-paperclip"></i>Bukti Transaksi</div>';
      html += buktiBayar(item.bukti);
    }
  } else if (item.source === 'pembelian_atk') {
    document.getElementById('modalDetailJudul').innerHTML = '<i class="bi bi-basket me-2"></i>Detail Pembelian ATK';
    html += mRow('bi-upc-scan','Kode Pembelian','<span class="modal-kode">'+(item.kode_pembelian||'-')+'</span>');
    html += mRow('bi-calendar3','Tanggal Pembelian',fTgl(item.tanggal));
    html += mRow('bi-cash','Total Harga','<span class="modal-amount">Rp '+fRp(item.jumlah)+'</span>');
    if (item.bukti) {
      html += '<div class="modal-sec"><i class="bi bi-paperclip"></i>Bukti Pembelian</div>';
      html += buktiBayar(item.bukti);
    }
    if (item.detail_items && item.detail_items.length > 0) {
      html += '<div class="modal-sec mt-3"><i class="bi bi-list-ul"></i>Daftar Item ATK</div>';
      html += '<table class="modal-table"><thead><tr><th>Nama ATK</th><th>Qty</th><th>Satuan</th><th class="text-end">Harga</th><th class="text-end">Subtotal</th></tr></thead><tbody>';
      item.detail_items.forEach(function(d){
        html += '<tr><td>'+d.nama_atk+'</td><td class="text-center">'+d.qty+'</td><td>'+(d.satuan||'-')+'</td><td class="text-end">Rp '+fRp(d.harga)+'</td><td class="text-end">Rp '+fRp(d.subtotal)+'</td></tr>';
      });
      html += '</tbody></table>';
    }
  }
  document.getElementById('modalDetailBody').innerHTML = html;
  document.getElementById('modalDetailOverlay').classList.add('active');
  document.body.style.overflow = 'hidden';
}

/* ---------- MODAL LIST GAJI GURU ---------- */
function bukaModalGaji(item) {
  const key = item.bulan_tahun_key;
  const list = gajiGuruDetails[key] || [];
  document.getElementById('modalGajiJudul').innerHTML =
    '<i class="bi bi-people me-2"></i>Daftar Gaji Guru &mdash; '+item.bulan_nama+' '+item.tahun;

  let html = '';

  // Info ringkasan
  html += '<div class="d-flex justify-content-between align-items-center mb-3">';
  html += '<span style="color:#5D4037;font-size:14px"><i class="bi bi-people me-1"></i><strong>'+list.length+'</strong> Guru</span>';
  html += '<span class="modal-amount" style="font-size:15px">Total: Rp '+fRp(item.jumlah)+'</span>';
  html += '</div>';

  if (list.length === 0) {
    html += '<div class="text-center py-4" style="color:#9E9E9E"><i class="bi bi-inbox" style="font-size:2.5rem"></i><p class="mt-2">Tidak ada data guru</p></div>';
  } else {
    html += '<div class="table-responsive"><table class="modal-table">';
    html += '<thead><tr><th class="text-center" width="5%">No</th><th>Nama Guru</th><th class="text-center">Tanggal Digaji</th><th class="text-end">Total Gaji</th><th class="text-center no-print">Aksi</th></tr></thead><tbody>';
    list.forEach(function(g, i){
      html += '<tr>';
      html += '<td class="text-center">'+(i+1)+'</td>';
      html += '<td><i class="bi bi-person-circle me-1" style="color:#A0522D"></i>'+g.nama_guru+'</td>';
      html += '<td class="text-center"><i class="bi bi-calendar3 me-1" style="color:#A0522D"></i>'+(g.tanggal||'-')+'</td>';
      html += '<td class="text-end" style="font-weight:700;color:#5D4037">Rp '+fRp(g.total_gaji)+'</td>';
      html += '<td class="text-center"><a href="/perhitungan_gaji_guru/'+g.id+'" class="btn-rincian"><i class="bi bi-file-earmark-text"></i>Rincian</a></td>';
      html += '</tr>';
    });
    html += '</tbody></table></div>';
  }

  document.getElementById('modalGajiBody').innerHTML = html;
  document.getElementById('modalGajiOverlay').classList.add('active');
  document.body.style.overflow = 'hidden';
}

/* ---------- HELPERS ---------- */
function tutupModal(id) {
  document.getElementById(id).classList.remove('active');
  document.body.style.overflow = '';
}
function tutupModalLuar(e, id) {
  if (e.target === document.getElementById(id)) tutupModal(id);
}
function mRow(icon, lbl, val) {
  return '<div class="modal-row"><div class="modal-lbl"><i class="bi '+icon+'"></i>'+lbl+'</div><div class="modal-val">'+val+'</div></div>';
}
function fRp(n) {
  if (!n && n !== 0) return '0';
  return parseInt(n).toLocaleString('id-ID');
}
function fTgl(tgl) {
  if (!tgl) return '-';
  const d = new Date(tgl);
  if (isNaN(d)) return tgl;
  const bl = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
  return d.getDate()+' '+bl[d.getMonth()]+' '+d.getFullYear();
}
function buktiBayar(path) {
  const ext = path.split('.').pop().toLowerCase();
  const url = '/storage/'+path;
  if (['jpg','jpeg','png'].includes(ext)) {
    return '<div><img src="'+url+'" style="max-width:100%;border-radius:8px;border:2px solid #E0D5C7;margin-top:.5rem;cursor:zoom-in" onclick="document.getElementById(\'imgZoomSrc\').src=this.src;document.getElementById(\'imgZoomOverlay\').classList.add(\'active\')" alt="Bukti"></div>';
  } else if (ext === 'pdf') {
    return '<a href="'+url+'" target="_blank" class="btn btn-sm btn-danger mt-1"><i class="bi bi-file-earmark-pdf me-1"></i>Lihat PDF</a>';
  }
  return '<span class="modal-empty">Format tidak dikenali</span>';
}
document.addEventListener('keydown', function(e){
  if (e.key === 'Escape') {
    tutupModal('modalDetailOverlay');
    tutupModal('modalGajiOverlay');
    document.getElementById('imgZoomOverlay').classList.remove('active');
  }
});
</script>
@endsection