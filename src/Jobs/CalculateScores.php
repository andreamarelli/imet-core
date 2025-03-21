<?php

namespace ImetCore\Jobs;

use ImetCore\Services\Scores\ImetScores;
use ImetCore\Services\Scores\OecmScores;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use ImetCore\Models\Imet\v2\Imet as ImetV2;
use ImetCore\Models\Imet\oecm\Imet as ImetOECM;
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
        $IMETs = ImetV2::select(['FormID', 'version'])->get();
        foreach($IMETs as $imet){
            ImetScores::refresh_scores($imet);
            Log::info('IMET #' . $imet . ' scores updated');
        }

        // OECM
        $OECMs = ImetOECM::select(['FormID'])->get();
        foreach($OECMs as $oecm){
            OecmScores::refresh_scores($oecm->FormID);
            Log::info('OECM #' . $oecm->FormID . ' scores updated');
        }

    }
}
