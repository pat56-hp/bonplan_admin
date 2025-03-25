<?php

namespace App\Repositories;

use App\Domain\ActivityRepositoryInterface;
use App\Models\Activity;

class ActivityRepository implements ActivityRepositoryInterface{
    private Activity $activity;

    public function __construct(Activity $activity){
        $this->activity = $activity;
    }

    /**
     * Sauvgarde des activités
     * @param array $data
     * @return void
     */
    public function save(array $data): void{
        $this->activity::saveActivity($data['module'], $data['action']);
    }
}