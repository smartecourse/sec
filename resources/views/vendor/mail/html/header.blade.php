<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="{{ asset('upload/logo-sec.jpg') }}" class="logo" alt="SEC Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
