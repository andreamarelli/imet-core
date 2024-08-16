<?php
/** @var string $attributes */
/** @var string $num_cols  */

$attributes = $attributes ?? '';
$num_cols = $num_cols ?? 3;

?>

<tbody v-else>
    <tr>
        <td colspan="{{ $num_cols }}" class="py-4">
            <div class="nothing_to_evaluate">
                @lang('imet-core::common.nothing_to_evaluate')
            </div>
        </td>
    </tr>
</tbody>