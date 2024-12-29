<td style="text-align: center;">
    <div style="width: 120%;">
        Jakarta, {{ now()->translatedFormat('d, F Y') }} <br />
    </div>
    Mengetahui,<br />
    
    <!-- Gambar tanda tangan penanggung jawab -->
    @if (request('output') == 'pdf')
        <img src="{{ storage_path() . '/app/' . settings()->get('pj_ttd') }}" alt="" width="130" style="display: block; margin: 0 auto;">
    @else
        <img src="{{ Storage::url(settings()->get('pj_ttd')) }}" width="130" style="display: block; margin: 0 auto;">
    @endif
    
    <!-- Div untuk garis bawah dan nama penanggung jawab -->
    <div style="width: 200px; border-bottom: 1px solid black; margin: 0 auto; text-align: center;">
        {{ settings()->get('pj_nama') }}
    </div>
    
    <!-- Jabatan penanggung jawab -->
    <div style="text-align: center;">{{ settings()->get('pj_jabatan') }}</div>
</td>