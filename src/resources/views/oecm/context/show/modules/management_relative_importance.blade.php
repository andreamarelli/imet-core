<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $records */

$value = strval($records[0]['RelativeImportance']);

?>


<div id="relative_importance">
    <div>
        @uclang('imet-core::oecm_context.ManagementRelativeImportance.equal')
        <input type="radio" id="equal" value="0" disabled {!! $value==='0' ? 'checked="checked"' : '' !!}>
    </div>
    <div>
        <div class="row_title">@uclang('imet-core::oecm_context.ManagementRelativeImportance.majority_by')</div>
        <div>
            <label for="maj_staff">@uclang('imet-core::oecm_context.ManagementRelativeImportance.staff')</label>
            <input type="radio" id="maj_staff" value="-1" disabled {!! $value==='-1' ? 'checked="checked"' : '' !!}>
        </div>
        <div>
            <label for="maj_stakeholders">@uclang('imet-core::oecm_context.ManagementRelativeImportance.stakeholders')</label>
            <input type="radio" id="maj_stakeholders" value="1" disabled {!! $value==='1' ? 'checked="checked"' : '' !!}>
        </div>
    </div>
    <div>
        <div class="row_title">@uclang('imet-core::oecm_context.ManagementRelativeImportance.all_by')</div>
        <div>
            <label for="all_staff">@uclang('imet-core::oecm_context.ManagementRelativeImportance.staff')</label>
            <input type="radio" id="all_staff" value="-2" disabled {!! $value==='-2' ? 'checked="checked"' : '' !!}>
        </div>
        <div>
            <label for="all_stakeholders">@uclang('imet-core::oecm_context.ManagementRelativeImportance.stakeholders')</label>
            <input type="radio" id="all_stakeholders" value="2" disabled {!! $value==='2' ? 'checked="checked"' : '' !!}>
        </div>
    </div>
</div>



@push('scripts')
    <style>
        #relative_importance{
            display: flex;
            flex-direction: column;
            row-gap: 15px;
            align-items: center;
        }
        #relative_importance > div{
            display: flex;
            column-gap: 20px;
        }
        #relative_importance label{
            font-weight: bold;
            margin-right: 5px;
        }
        #relative_importance .row_title{
            width: 250px;
            text-align: right;
            display: inline-block;
     }
    </style>
@endpush