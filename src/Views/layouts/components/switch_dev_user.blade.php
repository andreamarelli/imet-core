<?php
use AndreaMarelli\ImetCore\Models\User\Role;

?>

@if(\App::environment('imetglobal_dev'))
    <li>
        <a>{!! \AndreaMarelli\ModularForms\Helpers\Template::icon('random', '', '', 'fa-lg') !!} Change USER</a>
        <ul class="language_selector">

            <!--  #### ROLE_ADMINISTRATOR  #### -->
            <li>
                <a href="#" onclick="event.preventDefault(); document.getElementById('switch_to_administrator_user-form').submit();">
                    {{ Role::ROLE_ADMINISTRATOR }}
                </a>
                <form id="switch_to_administrator_user-form" action="{{ route('change_user') }}" method="POST" class="d-none">
                    <input type="hidden" name="imet_role" value="{{ Role::ROLE_ADMINISTRATOR }}" />
                    @csrf
                </form>
            </li>

            <!--  #### ROLE_AUTHORITY  #### -->
            <li>
                <a href="#" onclick="event.preventDefault(); document.getElementById('switch_to_authority_user-form').submit();">
                    {{ Role::ROLE_AUTHORITY }}
                </a>
                <form id="switch_to_authority_user-form" action="{{ route('change_user') }}" method="POST" class="d-none">
                    <input type="hidden" name="imet_role" value="{{ Role::ROLE_AUTHORITY }}" />
                    @csrf
                </form>
            </li>

            <!--  #### ROLE_OBSERVATORY  #### -->
            <li>
                <a href="#" onclick="event.preventDefault(); document.getElementById('switch_to_observatory_user-form').submit();">
                    {{ Role::ROLE_OBSERVATORY }}
                </a>
                <form id="switch_to_observatory_user-form" action="{{ route('change_user') }}" method="POST" class="d-none">
                    <input type="hidden" name="imet_role" value="{{ Role::ROLE_OBSERVATORY }}" />
                    @csrf
                </form>
            </li>

            <!--  #### ROLE_ENCODER  #### -->
            <li>
                <a href="#" onclick="event.preventDefault(); document.getElementById('switch_to_encoder_user-form').submit();">
                    {{ Role::ROLE_ENCODER }}
                </a>
                <form id="switch_to_encoder_user-form" action="{{ route('change_user') }}" method="POST" class="d-none">
                    <input type="hidden" name="imet_role" value="{{ Role::ROLE_ENCODER }}" />
                    @csrf
                </form>
            </li>

        </ul>
    </li>
@endif
