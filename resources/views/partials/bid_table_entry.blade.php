@inject('helper', \App\Helpers\LbawUtils::class)

<tr>
    @isset($bid_no)
    <td>{{ $bid_no }}</td>
    @endisset
    <td>
        <i class="bi bi-person-circle ms-2" style="font-size: 1.2rem;"></i>
        {{ $helper->encodeUsername($auction, $bid->bidder_id)}}
    </td>

    <td>{{ $helper->formatCurrency($value) }} &phi;</td>
    <td>{{ $time }}</td>
</tr>
