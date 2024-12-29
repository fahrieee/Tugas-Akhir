
<tr>
    <td width="80" style="padding-left: 20px;">
        @if (request('output') =='pdf')
            <img src="{{ storage_path() . '/app/' . settings()->get('app_logo') }}" alt="" width="170" height="50">
        @else
            <img src="{{ \Storage::url(settings()->get('app_logo')) }}" alt="" width="170" height="50">
        @endif
    </td>
    <td style="text-align:left;vertical-align: middle;padding-left: 7px;">
        <div style="font-size: 28px;font-weight:bold">{{ settings()->get('app_name', 'My App') }}</div>
        <div>{{ settings()->get('app_address') }}</div>
    </td>
</tr>                               
