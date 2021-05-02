@inject('helper', \App\Helpers\LbawUtils::class)

<tr>
    @isset($bid_no)
    <td>{{ $bid_no }}</td>
    @endisset
    <td>
        @if ($name != "Starting Bid")
            <i class="bi bi-person-circle ms-2" style="font-size: 1.2rem;"></i>
        @endif

        {{ $name }}
    </td>

    <td>{{ $helper->formatCurrency($bid) }} &phi;</td>
    <td>{{ $time }}</td>
</tr>
