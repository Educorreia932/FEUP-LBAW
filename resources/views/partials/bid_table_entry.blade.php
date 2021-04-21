<tr>
    <td>
        @if ($name != "Starting Bid")
            <i class="bi bi-person-circle ms-2" style="font-size: 1.2rem;"></i>
        @endif

        {{ $name  }}
    </td>

    <td>{{ number_format($bid, 2) }} &euro;</td>
    <td>{{ $time }}</td>
</tr>
