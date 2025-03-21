<?php

namespace ImetCore\Models\Imet\v2\Modules\Context;

use ImetCore\Models\Imet\v2\Modules;
use ImetCore\Models\User\Role;
use ModularForms\Models\Traits\Payload;
use Illuminate\Http\Request;

class Habitats extends Modules\Component\ImetModule
{
    protected $table = 'context_habitats';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    protected static $DEPENDENCIES = [
        [Modules\Evaluation\ImportanceHabitats::class, 'EcosystemType'],
        [Modules\Evaluation\InformationAvailability::class, 'EcosystemType'],
        [Modules\Evaluation\KeyConservationTrend::class, 'EcosystemType'],
        [Modules\Evaluation\ManagementActivities::class, 'EcosystemType'],
    ];

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'CTX 4.3';
        $this->module_title = trans('imet-core::v2_context.Habitats.title');
        $this->module_fields = [
            ['name' => 'EcosystemType',             'type' => 'suggestion-ImetV2_Habitats',   'label' => trans('imet-core::v2_context.Habitats.fields.EcosystemType')],
            ['name' => 'Value',                     'type' => 'text-area',   'label' => trans('imet-core::v2_context.Habitats.fields.Value')],
            ['name' => 'Area',                      'type' => 'numeric',   'label' => trans('imet-core::v2_context.Habitats.fields.Area')],
            ['name' => 'DesiredConservationStatus', 'type' => 'numeric',   'label' => trans('imet-core::v2_context.Habitats.fields.DesiredConservationStatus')],
            ['name' => 'Sectors',                   'type' => 'text-area',   'label' => trans('imet-core::v2_context.Habitats.fields.Sectors')],
            ['name' => 'Comments',                  'type' => 'text-area',   'label' => trans('imet-core::v2_context.Habitats.fields.Comments')],
        ];

        $this->module_info = trans('imet-core::v2_context.Habitats.module_info');

        parent::__construct($attributes);

    }

    public static function upgradeModule($record, $imet_version = null)
    {
        // ####  v2.8 -> v2.10 (revised habitat list)  ####
        $record = static::replacePredefinedValue($record, 'EcosystemType', 'Forest temperate','forest_temperate_boreal');
        $record = static::replacePredefinedValue($record, 'EcosystemType', 'Forest boreal','forest_temperate_boreal');
        $record = static::replacePredefinedValue($record, 'EcosystemType', 'Subtropical/tropical moist lowland','forest_moist_lowland');
        $record = static::replacePredefinedValue($record, 'EcosystemType', 'Subtropical/tropical moist montane','forest_moist_montane');
        $record = static::replacePredefinedValue($record, 'EcosystemType', 'Subtropical/tropical dry','forest_dry');
        $record = static::replacePredefinedValue($record, 'EcosystemType', 'Subtropical/tropical swamp','swamp');
        $record = static::replacePredefinedValue($record, 'EcosystemType', 'Savanna-moist','savanna_moist');
        $record = static::replacePredefinedValue($record, 'EcosystemType', 'Savanna-dry','savanna_dry');
        $record = static::replacePredefinedValue($record, 'EcosystemType', 'Shrubland-Subtropical/tropical dry','shrubland_dry_moist');
        $record = static::replacePredefinedValue($record, 'EcosystemType', 'Shrubland-Subtropical/tropical moist','shrubland_dry_moist');
        $record = static::replacePredefinedValue($record, 'EcosystemType', 'Shrubland-Subtropical/tropical high altitude','shrubland_high_altitude');
        $record = static::replacePredefinedValue($record, 'EcosystemType', 'Shrubland temperate','shrubland_temperate_boreal');
        $record = static::replacePredefinedValue($record, 'EcosystemType', 'Shrubland boreal','shrubland_temperate_boreal');
        $record = static::replacePredefinedValue($record, 'EcosystemType', 'Grassland Temperate','grassland_temperate');
        $record = static::replacePredefinedValue($record, 'EcosystemType', 'Grassland subtropical/tropical dry','grassland_dry_moist');
        $record = static::replacePredefinedValue($record, 'EcosystemType', 'Wetlands (inland)-Permanent freshwater lakes','wetlands_lakes');
        $record = static::replacePredefinedValue($record, 'EcosystemType', 'Desert – Temperate','desert');
        $record = static::replacePredefinedValue($record, 'EcosystemType', 'Desert – Cold','desert');
        $record = static::replacePredefinedValue($record, 'EcosystemType', 'Desert - Hot','desert');
        $record = static::replacePredefinedValue($record, 'EcosystemType', 'Plantations','artificial');

        return $record;
    }

    /**
     *  Update 2.7 -> v2.8 (marine pas): merge CTX 4.3.2 into 4.3 ####
     *
     * @param array $data
     * @return array
     */
    public static function mergeFromCTX432(array $data): array
    {
        if(array_key_exists('HabitatsMarine', $data) && !empty($data['HabitatsMarine'])){

            foreach ($data['HabitatsMarine'] as $i=>$record){

                // #### Updates inherited from CTX4.3.2 ####
                $record['Presence'] = in_array($record['Presence'], [
                    'Present', 'Absent', 'Dominant', // EN
                    'Présent', 'Absent', 'Dominant', // FR
                    'Presente', 'Ausente', 'Dominante' // PT
                ]) ? $record['Presence'] : null;

                $data[static::getShortClassName()][] = [
                    static::UPDATED_AT => $record[static::UPDATED_AT],
                    static::UPDATED_BY => $record[static::UPDATED_BY],
                    'EcosystemType' => $record['HabitatType'],
                    'Value' => $record['Presence'],
                    'Area' => $record['Area'],
                    'Comments' => $record['Source'] . '. ' . $record['Description']
                ];
            }
        }

        return $data;
    }

    /**
     * Update 2.7 -> v2.8 (marine pas): merge CTX 4.4 into 4.3 ####
     *
     * @param array $data
     * @return array
     */
    public static function mergeFromCTX44(array $data): array
    {
        if(array_key_exists('LandCover', $data) && !empty($data['LandCover'])){
            foreach ($data['LandCover'] as $i=>$record){
                $data[static::getShortClassName()][] = [
                    static::UPDATED_AT => $record[static::UPDATED_AT],
                    static::UPDATED_BY => $record[static::UPDATED_BY],
                    'EcosystemType' => $record['CoverType'],
                    'Area' => $record['HistoricalArea'],
                    'DesiredConservationStatus' => $record['ConservationStatusArea'] ?? null,
                    'Comments' => $record['Notes']
                ];
            }
        }
        return $data;
    }

}
