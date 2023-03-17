<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Component;

use AndreaMarelli\ImetCore\Models\Imet\Components\Modules\ImetModule as BaseImetModule;
use AndreaMarelli\ImetCore\Models\Imet\Components\Upgrade;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Imet;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;


class ImetModule extends BaseImetModule
{
    use Upgrade;

    protected static $form_class = Imet::class;

    /**
     * Relation to IMET form
     * @return BelongsTo
     */
    public function imet(): BelongsTo
    {
        return $this->belongsTo(Imet::class, 'FormID');
    }

    public static function getVueData($form_id, $collection = null): array
    {
        $vue_data = parent::getVueData($form_id, $collection);

        // check for "warning_on_save" in labels end push to vue_data
        $this_class = static::class;
        $array_this_class = explode('\\', $this_class);
        $this_class_name = end($array_this_class);
        $labels = null;
        if(Str::contains($this_class, 'Modules\Context')){
            $label_prefix = 'imet-core::oecm_context.';
            $labels = trans($label_prefix . $this_class_name);
        } else if(Str::contains($this_class, 'Modules\Evaluation')){
            $label_prefix = 'imet-core::oecm_evaluation.';
            $labels = trans($label_prefix . $this_class_name);
        }
        if(array_key_exists('warning_on_save', $labels)){
            $vue_data['warning_on_save'] =  trans($label_prefix . $this_class_name . '.warning_on_save');
        }

        return $vue_data;
    }

    /**
     * Compare updated records with existing (in DB) and drop from dependant modules
     *
     * @param $form_id
     * @param $updated_records
     * @param $reference_field
     * @param $dependency_classes
     * @return void
     */
    public static function dropFromDependentModules($form_id, $updated_records, $reference_field, $dependency_classes)
    {
        // Get list of values (of reference field) from DB and from updated records
        $existing_values = static::getModule($form_id)->pluck($reference_field)->unique()->toArray();
        $updated_values = collect($updated_records)->pluck($reference_field)->unique()->toArray();

        // Make diff to find out what to drop
        $to_be_dropped = array_diff($existing_values, $updated_values);
        $to_be_dropped = array_values($to_be_dropped);

        foreach ($dependency_classes as [$dependency_class, $dependency_field]){
            /** @var ImetModule $dependency_class */
            $dependency_class::dropOrphansDependencyRecords($form_id, $dependency_field, $to_be_dropped);
        }
    }

    /**
     * Drop all records where first field is listed in the given reference list (use for dependent modules, ex: CTX -> Evaluation)
     *
     * @param $form_id
     * @param $reference_field
     * @param $to_be_dropped
     */
    public static function dropOrphansDependencyRecords($form_id, $reference_field, $to_be_dropped)
    {
        $records = static::getModule($form_id)->toArray();

        foreach ($records as $record) {
            if(in_array($record[$reference_field], $to_be_dropped)){
                static::destroy($record[(new static())->primaryKey]);
            }
        }
    }

}
