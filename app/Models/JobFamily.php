<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobFamily extends Model
{
    protected $table = 'Job_Family';
    protected $primaryKey ='id_Job_Family';
    public function jobType(){
        return $this->hasMany('App\Models\JobType', 'id_Job_Family');
    }
    protected function getJobsFamilyOptions()
    {
        $jobsFamily = [];
        $jobFamilyList = $this->all()->sortBy("Job_Family");
        foreach ($jobFamilyList as $jobFamily) {
            $jobsFamily[$jobFamily->id_Job_Family] = $jobFamily->Job_Family;
        }
        return $jobsFamily;
    }
}
