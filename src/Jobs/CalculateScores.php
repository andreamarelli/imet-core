<?php

namespace AndreaMarelli\ImetCore\Jobs;

use AndreaMarelli\ImetCore\Services\Statistics\OEMCStatisticsService;
use AndreaMarelli\ImetCore\Services\Statistics\V1ToV2StatisticsService;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use AndreaMarelli\ImetCore\Models\Imet\Imet;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Imet as ImetOECM;
use AndreaMarelli\ImetCore\Services\Statistics\V2StatisticsService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

/**
 * use this job to update assessments effectiveness scores
 * every time a change is made in an assessment
 * It will cache the scores pre imet in json format
 */
class CalculateScores implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;
    use Utils;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct() {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        // IMETs
        $imets = Imet::select(['FormID', 'version'])->get();
        foreach($imets as $imet){
            if($imet->version ===Imet::IMET_V2) {
                V2StatisticsService::get_scores($imet->FormID, 'ALL', false);
            } else {
                V1ToV2StatisticsService::get_scores($imet->FormID, 'ALL', false);
            }
            Log::info('IMET #' . $imet->FormID . ' scores updated');
        }

        // OECM
        $oecms = ImetOECM::select(['FormID'])->get();
        foreach($oecms as $oecm){
            OEMCStatisticsService::get_scores($oecm->FormID, 'ALL', false);
            Log::info('OECM #' . $oecm->FormID . ' scores updated');
        }

    }
}
