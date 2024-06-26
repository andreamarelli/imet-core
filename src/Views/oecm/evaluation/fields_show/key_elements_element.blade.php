<?php
/** @var String $type */
/** @var String $value */
/** @var bool $only_label */

$group_stakeholders = $record['__group_stakeholders'];
$num_stakeholders_direct = $record['__num_stakeholders_direct'];
$num_stakeholders_indirect = $record['__num_stakeholders_indirect'];

?>

<div class="field-preview">
    {{ $value }}
</div>


<div class="text-left text-xs" style="padding: 4px 4px 0 4px;">
    @if($group_stakeholders!==null)
        <div>
            @lang('imet-core::oecm_evaluation.KeyElements.from_group'):
            <b>{!! $group_stakeholders !!}</b>
        </div>
    @endif
    @if($record['group_key'] === 'group0')
        @if($num_stakeholders_direct!==null || $num_stakeholders_indirect!==null)
            <div>
                @lang('imet-core::oecm_evaluation.KeyElements.num_stakeholders', [
                    'num_dir' => '<b>'.$num_stakeholders_direct.'</b>',
                    'num_ind' => '<b>'.$num_stakeholders_indirect.'</b>'
                    ])
            </div>
        @endif
    @elseif($record['group_key'] === 'group1')
            <div>
                <b>@lang('imet-core::oecm_evaluation.KeyElements.ranking')</b>: {{ $record['__score'] }}
            </div>
    @endif
</div>
