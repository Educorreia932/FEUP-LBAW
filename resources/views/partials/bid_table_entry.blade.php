<tr class="@if($hide) bid-table-collapsible collapse @endif">
    <td>{{ $bid_no }}</td>
    @if(Auth::id() == $auction->seller_id)
    <td class="d-flex align-items-center">
        <div class="d-flex p-0 mx-2" style="width: 20px; height: 20px;">
            <img style="border-radius:50%;" width="20" height="20"
                    src={{ $bid->bidder->getImage() }}
                    alt="My Profile Image">
        </div>
        <span>{{ $bid->bidder->username }}</span>
        @if ($bid->id == $auction->latest_bid)
        <i class="bi bi-trophy-fill ms-2 text-primary"></i>
        @endif
    </td>
    @elseif(Auth::id() == $bid->bidder_id)
    <td class="d-flex align-items-center">
        <div class="d-flex p-0 mx-2" style="width: 20px; height: 20px;">
            <img style="border-radius:50%;" width="20" height="20"
                    src={{ Auth::user()->getImage('small') }}
                    alt="My Profile Image">
        </div>
        <span>Me</span>
        @if ($bid->id == $auction->latest_bid)
        <i class="bi bi-trophy-fill ms-2 text-primary"></i>
        @endif
    </td>
    @else
    <td>
        <i class="bi bi-person-circle mx-2" style="font-size: 1.2rem;"></i>
        <span>@encodeUsername($auction, $bid->bidder_id)</span>
        @if ($bid->id == $auction->latest_bid)
        <i class="bi bi-trophy-fill ms-2 text-primary"></i>
        @endif
    </td>
    @endif

    <td>@currency($value) &phi;</td>
    <td>{{ $time }}</td>
</tr>
