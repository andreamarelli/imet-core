<?php
/** @var Mixed $definitions */
?>

<div class="module-header">
    @if($definitions['module_code']!==null)
        <div class="module-code text-center">
            {!! ucfirst($definitions['module_code']) !!}
        </div>
    @endif
    <div class="module-title">
        {!! ucfirst($definitions['module_title']) !!}
    </div>

    @if(array_key_exists('module_scope', $definitions))
        <div class="module-type">
            {!! AndreaMarelli\ImetCore\Helpers\Template::module_scope($definitions['module_scope']) !!}
        </div>
    @endif

</div>
