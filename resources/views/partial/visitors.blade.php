<h6>
    Yours unique visitors/browsers <u>for the today</u>
</h6>
@if ($visitors->count() > 0)
    <div class="row">
        <div class="col-12 px-4">
            @foreach ($visitors as $item)
                @php $browser = sprintf("%s/%s", $item->browser, $item->version) @endphp
                <small>
                    <abbr title="{{$item->uniq}} visitors from the {{$browser}}">
                        {{$browser}}
                    </abbr>
                    <strong>
                        {{$item->uniq}}
                    </strong>
                    @if (!$loop->last)
                        <span class="text-muted">|</span>
                    @endif
                </small>
            @endforeach
        </div>
    </div>
@else
    <p>Unfortunately, today you have no visitors :(</p>
@endif