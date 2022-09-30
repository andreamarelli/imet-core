<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2;

use Illuminate\Database\Eloquent\Model;


/**
 * Class Assessment
 *
 * @property mixed $context
 * @property mixed $planning
 * @property mixed $inputs
 * @property mixed $process
 * @property mixed $outputs
 * @property mixed $outcomes
 *
 */
class Assessment extends Model
{
    protected $table = 'imet_assessment_v2.v_imet_eval_stat_step_summary';
    protected $primaryKey = 'formid';


    public function radar(): array
    {
        return [
            'C' => $this->context,
            'P' => $this->planning,
            'I' => $this->inputs,
            'PR' => $this->process,
            'OP' => $this->outputs,
            'OC' => $this->outcomes
        ];
    }

    /**
     * @return double
     */
    public function imet_index(): float
    {
        return round(($this->context + $this->planning + $this->inputs + $this->process + $this->outputs + $this->outcomes) / 6, 2);
    }


}
