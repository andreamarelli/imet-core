<?php
/** @var array $governance */
?>

<h3>1. @lang('imet-core::oecm_context.Governance.management') </h3>
<table>
    <tr>
        <td><b>@lang('imet-core::oecm_context.Governance.fields.GovernanceModel')</b></td>
        <td>@lang('imet-core::oecm_lists.GovernanceModel.'.$governance['GovernanceModel'])</td>
    </tr>
    <tr>
        <td><b>@lang('imet-core::oecm_context.Governance.fields.AdditionalInfo')</b></td>
        <td>{{ $governance['AdditionalInfo'] }}</td>
    </tr>
    <tr>
        <td><b>@lang('imet-core::oecm_context.Governance.fields.ManagementUnique')</b></td>
        <td>@lang('imet-core::oecm_lists.ManagementUnique.'.$governance['ManagementUnique'])</td>
    </tr>
    <tr>
        <td><b>@lang('imet-core::oecm_context.Governance.fields.ManagementList')</b></td>
        <td>{{ $governance['ManagementList'] }}</td>
    </tr>
    <tr>
        <td><b>@lang('imet-core::oecm_context.Governance.fields.DateOfCreation')</b></td>
        <td>{{ $governance['DateOfCreation'] }}</td>
    </tr>
    <tr>
        <td><b>@lang('imet-core::oecm_context.Governance.fields.OfficialRecognition')</b></td>
        <td>{{ $governance['OfficialRecognition'] }}</td>
    </tr>
    <tr>
        <td><b>@lang('imet-core::oecm_context.Governance.fields.SupervisoryInstitution')</b></td>
        <td>{{ $governance['SupervisoryInstitution'] }}</td>
    </tr>

</table>