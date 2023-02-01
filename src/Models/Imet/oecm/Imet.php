<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm;

use AndreaMarelli\ImetCore\Models\Imet\Imet as BaseImetForm;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Context\ResponsablesInterviewees;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Context\ResponsablesInterviewers;
use AndreaMarelli\ImetCore\Models\User\Role;
use AndreaMarelli\ModularForms\Helpers\Type\Chars;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class Imet extends BaseImetForm
{
    public const version = 'oecm';
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

    /**
     * Retrieve the IMET assessments list (clean, without statistics):  V1 & v2 merged
     *
     * @param Request $request
     * @param array $relations
     * @param bool $only_allowed_wdpas
     * @return mixed
     */
    public static function get_assessments_list(Request $request, array $relations = [], bool $only_allowed_wdpas = false) {
        $allowed_wdpas = $only_allowed_wdpas
            ? Role::allowedWdpas()
            : null;

        return Imet
            ::filterList($request)
            ->with($relations)
            ->where(function ($query) use ($allowed_wdpas) {
                if ($allowed_wdpas !== null) {
                    $query->whereIn('wdpa_id', $allowed_wdpas);
                }
            })
            ->get()
            // Replacement for PostgreSQL unaccent() function
            ->filter(function($item) use ($request){
                if ($request->filled('search')){
                    return Chars::case_and_accent_insensitive_contains($item['name'], $request->input('search'))
                        || Str::contains($item['wdpa_id'], $request->input('search'));
                }
                return true;
            });
    }



}
