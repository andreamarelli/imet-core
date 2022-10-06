<?php

use \AndreaMarelli\ImetCore\Models\User\Role;

$links = [
    [
        'url' => route('imet-core::users', ['role_type' => Role::ROLE_ADMINISTRATOR]),
        'label' => ucfirst(trans_choice('imet-core::users.role.' . Role::ROLE_ADMINISTRATOR, 2))
    ],
    [
        'url' => route('imet-core::users', ['role_type' => Role::ROLE_AUTHORITY]),
        'label' => ucfirst(trans_choice('imet-core::users.role.' . Role::ROLE_AUTHORITY, 2))
    ],
    [
        'url' => route('imet-core::users', ['role_type' => Role::ROLE_OBSERVATORY]),
        'label' => ucfirst(trans_choice('imet-core::users.role.' . Role::ROLE_OBSERVATORY, 2))
    ],
    [
        'url' => route('imet-core::users', ['role_type' => Role::ROLE_ENCODER]),
        'label' => ucfirst(trans_choice('imet-core::users.role.' . Role::ROLE_ENCODER, 2))
    ],
    [
        'url' => route('imet-core::users', ['role_type' => Role::ROLE_VIEWER]),
        'label' => ucfirst(trans_choice('imet-core::users.role.' . Role::ROLE_VIEWER, 2))
    ],
];

?>

<nav class="steps">
    @foreach($links as $i => $link)
        <a class="step
            @if(url()->current()===$link['url'] || ($i===0 && url()->current()=== route('imet-core::users', ['role_type' => null])))
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
