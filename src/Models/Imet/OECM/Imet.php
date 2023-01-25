<?php

namespace AndreaMarelli\ImetCore\Models\Imet\OECM;

use AndreaMarelli\ImetCore\Models\Imet\OECM\Modules\Context\ResponsablesInterviewees;
use AndreaMarelli\ImetCore\Models\Imet\OECM\Modules\Context\ResponsablesInterviewers;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Imet extends \AndreaMarelli\ImetCore\Models\Imet\Imet
{
    public static $modules = [

        'general_info' => [
            Modules\Context\ResponsablesInterviewers::class,
            Modules\Context\ResponsablesInterviewees::class,
        ],
        'areas' => [],
        'resources' => [],
        'key_elements' => [],
        'threats' => [],
        'climate' => [],
        'ecosystem_services' => [],
        'objectives' => []
    ];

    /**
     * Relation to ResponsablesInterviewees
     *
     * @return HasMany
     */
    public function responsible_interviewees(): HasMany
    {
        return $this->hasMany(ResponsablesInterviewees::class, $this->primaryKey, 'FormID')
            ->select(['FormID','Name']);
    }

    /**
     * Relation to ResponsablesInterviewers
     *
     * @return HasMany
     */
    public function responsible_interviewers(): HasMany
    {
        return $this->hasMany(ResponsablesInterviewers::class, $this->primaryKey, 'FormID')
            ->select(['FormID','Name']);
    }


}
