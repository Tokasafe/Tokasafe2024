@props(['url'])
<tr>
    <td class="header">
        <a href="{{ $url }}" style="display: inline-block;">
            @if (trim($slot) === 'TokaSafe')
                <img src="https://i.ibb.co/Px1Nbyr/1-1.png" class="logo" style="width: 96px" alt="Laravel Logo">
            @else
                {{ $slot }}
            @endif
        </a>
    </td>
</tr>
