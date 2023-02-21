<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Component;

use AndreaMarelli\ImetCore\Models\Imet\Components\Modules\ImetModule as BaseImetModule;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Imet;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class ImetModule extends BaseImetModule
{
    /**
     * Relation to IMET form
     * @return BelongsTo
     */
    public function imet(): BelongsTo
    {
        return $this->belongsTo(Imet::class, 'FormID');
    }

}
