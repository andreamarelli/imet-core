<?php

namespace   AndreaMarelli\ImetCore\Helpers;

class Database
{
    public const PUBLIC_SCHEMA = '';
    public const IMET_SCHEMA = 'imet';
    public const OECM_SCHEMA = 'oecm';

    /**
     * Get schema and connection according to the environment (offline or online)
     * Use different databases (SQLITE) for offline version and different schemas for online version (PostGreSQL)
     */
    static public function getSchemaAndConnection($requested_schema = null): array
    {
        $is_offline = app('APP_ENV') == 'imet_offline';

        // Set Connection
        $connection = $is_offline ? 'offline_imet' : config('database.default');

        // Set Schema
        $schema = $is_offline ? '' : ($requested_schema ?? $requested_schema . '.');

        return [$schema, $connection];
    }
}