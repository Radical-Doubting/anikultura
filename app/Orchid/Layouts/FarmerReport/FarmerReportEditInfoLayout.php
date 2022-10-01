<?php

namespace App\Orchid\Layouts\FarmerReport;

use App\Models\Crop\Crop;
use App\Models\Crop\SeedStage;
use App\Models\Farmland\Farmland;
use App\Models\User\Farmer\Farmer;
use App\Orchid\Layouts\AnikulturaEditLayout;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;

class FarmerReportEditInfoLayout extends AnikulturaEditLayout
{
    protected function fields(): iterable
    {
        $currentReport = $this->query->get('farmerReport');
        $isHarvested = false;

        $farmlandRelationField = Relation::make('farmerReport.farmland_id')
            ->fromModel(Farmland::class, 'name')
            ->displayAppend('fullName')
            ->required()
            ->title(__('Farmland'))
            ->placeholder(__('Farmland'));

        if ($currentReport->exists) {
            $isHarvested = $currentReport->isHarvested();
            $farmlandRelationField->applyScope('farmerBelongToFarmland', $currentReport->farmer->id);
        }

        return [
            Relation::make('farmerReport.reported_by')
                ->fromModel(Farmer::class, 'name')
                ->searchColumns('first_name', 'last_name')
                ->displayAppend('fullName')
                ->required()
                ->help(__('The farmer who submitted this farming report'))
                ->title(__('Reported by'))
                ->placeholder(__('Reported by')),

            Relation::make('farmerReport.seed_stage_id')
                ->fromModel(SeedStage::class, 'name')
                ->required()
                ->title(__('Seed Stage'))
                ->placeholder(__('Seed Stage')),

            Group::make([
                $farmlandRelationField,

                Relation::make('farmerReport.crop_id')
                    ->fromModel(Crop::class, 'name')
                    ->required()
                    ->title(__('Crop'))
                    ->placeholder(__('Crop')),
            ]),

            Input::make('farmerReport.volume_kg')
                ->type('number')
                ->max(255)
                ->title($isHarvested ? __('Yield Volume (kg)') : '')
                ->placeholder(__('Yield Volume (kg)'))
                ->hidden(! $isHarvested),
        ];
    }
}
