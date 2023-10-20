<?php

namespace AndreaMarelli\ImetCore\Jobs;

use AndreaMarelli\ImetCore\Services\Scores\OEMCScoresService;
use AndreaMarelli\ImetCore\Services\Scores\ScoresService;
use AndreaMarelli\ImetCore\Services\Scores\V1ToV2ScoresService;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use AndreaMarelli\ImetCore\Models\Imet\Imet;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Imet as ImetOECM;
use AndreaMarelli\ImetCore\Services\Scores\V2ScoresService;
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
                V2ScoresService::get_scores($imet->FormID, ScoresService::ALL_SCORES, false);
            } else {
                V1ToV2ScoresService::get_scores($imet->FormID, ScoresService::ALL_SCORES, false);
            }
            Log::info('IMET #' . $imet->FormID . ' scores updated');
        }

        // OECM
        $oecms = ImetOECM::select(['FormID'])->get();
        foreach($oecms as $oecm){
            OEMCScoresService::get_scores($oecm->FormID, ScoresService::ALL_SCORES, false);
            Log::info('OECM #' . $oecm->FormID . ' scores updated');
        }

    }
}
