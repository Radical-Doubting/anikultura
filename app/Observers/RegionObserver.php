<?php

namespace App\Observers;

use App\Actions\Insights\CreateInsightMetric;
use App\Models\Site\Region;
use InfluxDB2\Point;

class RegionObserver
{
    /**
     * Handle the Region "saved" event.
     *
     * @param  \App\Models\Site\Region  $region
     * @return void
     */
    public function saved(Region $region)
    {
        CreateInsightMetric::dispatch([
            Point::measurement('regions')
                ->addTag('location', $region->slug)
                ->addField('level', 2)
                ->time(time()),
        ]);
    }
}
