<?php

use \AndreaMarelli\ImetCore\Models\User\Role;

$links = [
    [
        'url' => route('users', ['role_type' => Role::ROLE_ADMINISTRATOR]),
        'label' => ucfirst(Role::ROLE_ADMINISTRATOR)
    ],
    [
        'url' => route('users', ['role_type' => Role::ROLE_AUTHORITY]),
        'label' => ucfirst(Role::ROLE_AUTHORITY)
    ],
    [
        'url' => route('users', ['role_type' => Role::ROLE_OBSERVATORY]),
        'label' => ucfirst(Role::ROLE_OBSERVATORY)
    ],
    [
        'url' => route('users', ['role_type' => Role::ROLE_ENCODER]),
        'label' => ucfirst(Role::ROLE_ENCODER)
    ],
];

?>

<nav class="steps">
    @foreach($links as $i => $link)
        <a class="step
            @if(url()->current()===$link['url'] || ($i===0 && url()->current()=== route('users', ['role_type' => null])))
                selected
            @endif
            "
           href="{{ $link['url'] }}">{{ $link['label'] }}</a>
    @endforeach
</nav>

@push('scripts')

    <style>
        nav.steps a.step{
            padding: 20px 10px;
            overflow-wrap: normal;
            min-width: auto;
        }
    </style>


@endpush