@auth()
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            {!! Avatar::create(auth()->user()->name)
                    ->setDimension(36, 36)
                    ->setFontSize(14)
                    ->toSvg() !!}
        </div>
        <div class="info">
            @php
            $url = can('change_own_account') ? route('users.edit', auth()->id()) : "#";
            @endphp
            <a href="{{ $url }}" class="d-block">{{ auth()->user()->name }}</a>
        </div>
    </div>
@endauth
