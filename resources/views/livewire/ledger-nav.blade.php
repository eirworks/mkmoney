<div>
    <ul class="nav nav-tabs">
        @foreach($types as $key => $type)
            <li class="nav-item"><a href="javascript:void(0);" wire:click="$emit('ledgerNavChanged', '{{ $key }}')" class="nav-link {{ $key == $selected ? 'active' : '' }}">{{ $type }} ({{ ucwords($key) }})</a></li>
        @endforeach
    </ul>
</div>
