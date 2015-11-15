<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobType extends Model
{
    protected $table = 'Job_Type';
    protected $primaryKey ='id_Job_Type';


    protected function getJobsTypesByJobFamilyOptions($jobFamily = 1)
    {
        $jobTypes = [];
        $jobTypesList = $this->where("id_Job_Family", "=", $jobFamily)->get();
        foreach ($jobTypesList as $jobType)
        {
            $jobTypes[$jobType->id_Job_Type] = $jobType->Job_Type;
        }
        return $jobTypes;
    }

}
