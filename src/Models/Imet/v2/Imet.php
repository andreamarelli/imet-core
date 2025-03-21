<?php

namespace ImetCore\Models\Imet\v2;

use ImetCore\Controllers\Imet\v2\Controller;
use ImetCore\Helpers\Database;
use ImetCore\Models\Imet\v2\Encoder;
use ImetCore\Models\Imet\Imet as BaseImetForm;
use ImetCore\Models\Imet\v2\Modules\Context\FinancialAvailableResources;
use ImetCore\Models\Imet\v2\Modules\Context\FinancialResourcesBudgetLines;
use ImetCore\Models\Imet\v2\Modules\Context\FinancialResourcesPartners;
use ImetCore\Models\Imet\v2\Modules\Context\Habitats;
use ImetCore\Models\Imet\v2\Modules\Context\ResponsablesInterviewees;
use ImetCore\Models\Imet\v2\Modules\Context\ResponsablesInterviewers;
use ImetCore\Services\Scores\ImetScores;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class Imet extends BaseImetForm
{
    public const version = 'v2';
    protected string $schema = Database::IMET_SCHEMA;
    protected $connection = Database::IMET_CONNECTION;
    protected $table = 'imet_form';

    public static $modules = [

        'general_info' => [
            Modules\Context\ResponsablesInterviewers::class,
            Modules\Context\ResponsablesInterviewees::class,
            Modules\Context\GeneralInfo::class,
            Modules\Context\Governance::class,
            Modules\Context\SpecialStatus::class,
            Modules\Context\Networks::class,
            Modules\Context\Missions::class,
            Modules\Context\Contexts::class,
            Modules\Context\Objectives1::class
        ],
        'areas' => [
            Modules\Context\GeographicalLocation::class,
            Modules\Context\Areas::class,
            Modules\Context\Sectors::class,
            Modules\Context\TerritorialReferenceContext::class,
            Modules\Context\Objectives2::class,
        ],
        'resources' => [
            Modules\Context\ManagementStaff::class,
            Modules\Context\ManagementStaffPartners::class,
            Modules\Context\ManagementStaffCommunities::class,
            Modules\Context\FinancialResources::class,
            Modules\Context\FinancialAvailableResources::class,
            Modules\Context\FinancialResourcesBudgetLines::class,
            Modules\Context\FinancialResourcesPartners::class,
            Modules\Context\Equipments::class,
            Modules\Context\Objectives3::class,
        ],
        'key_elements' => [
            Modules\Context\AnimalSpecies::class,
            Modules\Context\VegetalSpecies::class,
            Modules\Context\Habitats::class,
            Modules\Context\Objectives4::class,
        ],
        'threats'  => [
            Modules\Context\MenacesPressions::class,
            Modules\Context\Objectives5::class,
        ],
        'climate'  => [
            Modules\Context\ClimateChange::class,
            Modules\Context\Objectives6::class,
        ],
        'ecosystem_services' => [
            Modules\Context\EcosystemServices::class,
            Modules\Context\Objectives7::class,
        ],
        'objectives' => [
            Modules\Context\Objectives1::class,
            Modules\Context\Objectives2::class,
            Modules\Context\Objectives3::class,
            Modules\Context\Objectives4::class,
            Modules\Context\Objectives5::class,
            Modules\Context\Objectives6::class,
            Modules\Context\Objectives7::class,
        ]
    ];

    /**
     * Relation to Encoder (only name)
     *
     * @return HasMany
     */
    public function encoder(): HasMany
    {
        return $this->hasMany(Encoder::class, $this->primaryKey, 'FormID')
            ->select(['FormID', 'first_name', 'last_name']);
    }

    /**
     * Relation to ResponsablesInterviewees
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function responsible_interviewees(): HasMany
    {
        return $this->hasMany(ResponsablesInterviewees::class, $this->primaryKey, 'FormID')
            ->select(['FormID','Name']);
    }

    /**
     * Relation to ResponsablesInterviewers
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function responsible_interviewers(): HasMany
    {
        return $this->hasMany(ResponsablesInterviewers::class, $this->primaryKey, 'FormID')
            ->select(['FormID','Name']);
    }

    /**
     * Get IMET available years for the given PA
     *
     * @param $wdpa_id
     * @return \ImetCore\Models\Imet\v2\Imet[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function getYears($wdpa_id)
    {
        return (new static())
            ->where('wdpa_id', $wdpa_id)
            ->orderBy('Year','DESC')
            ->get();
    }

    /**
     * Extent parent method: save user as encoder
     *
     * @param $item
     * @param Request $request
     * @return mixed
     * @throws \Exception
     */
    public static function updateModuleAndForm($item, Request $request): array
    {
        $return = parent::updateModuleAndForm($item, $request);

        // backup to JSON
        if ($return['status'] == 'success') {
            (new Controller())->backup($item, Imet::version);
        }

        // Update encoder UPDATED_AT
        $user_info = Auth::user()->getInfo();
        unset($user_info['country']);
        Encoder::touchOnFormUpdate($item, $user_info);

        // Refresh scores
        ImetScores::refresh_scores($item);

        return $return;
    }

    /**
     * Override: apply changes
     *
     * @param $data
     * @param null $imet_version
     * @return array
     */
    public static function upgradeModules($data, $imet_version = null): array
    {
        if(array_key_exists('FinancialResources', $data)){
            $data = FinancialAvailableResources::copyCurrencyFromCTX213($data);
            $data = FinancialResourcesBudgetLines::copyCurrencyFromCTX213($data);
            $data = FinancialResourcesPartners::copyCurrencyFromCTX213($data);
        }

        // ####  v2.7 -> v2.8 (marine pas):  merge CTX 4.3.1, 4.3.2, 4.4 into 4.3 ####
        $data = Habitats::mergeFromCTX432($data);
        $data = Habitats::mergeFromCTX44($data);

        return parent::upgradeModules($data, $imet_version);
    }

}
