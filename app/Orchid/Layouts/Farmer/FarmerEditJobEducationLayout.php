<?php

namespace App\Orchid\Layouts\Farmer;

use App\Orchid\Layouts\AnikulturaEditLayout;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;

class FarmerEditJobEducationLayout extends AnikulturaEditLayout
{
    protected function fields(): iterable
    {
        return [
            Group::make([
                Select::make('farmer_profile.highest_educational_status')
                    ->title(__('Highest Educational Status'))
                    ->options(['Elementary', 'High School', 'College'])
                    ->required(),

                Input::make('farmer_profile.college_course')
                    ->title(__('College Course'))
                    ->placeholder(__('College Course'))
                    ->required(),
            ]),

            Group::make([
                Input::make('farmer_profile.current_job')
                    ->title(__('Current Job'))
                    ->placeholder(__('Current Job'))
                    ->required(),

                Input::make('farmer_profile.farming_years')
                    ->type('number')
                    ->min(1)
                    ->max(256)
                    ->title(__('Farming Years'))
                    ->placeholder(__('Farming Years'))
                    ->required(),
            ]),

            Group::make([
                Input::make('farmer_profile.usual_crops_planted')
                    ->title(__('Usual Crops Planted'))
                    ->placeholder(__('Usual Crops Planted'))
                    ->required(),

                Input::make('farmer_profile.affiliated_organization')
                    ->title(__('Affiliated Organization'))
                    ->placeholder(__('Affiliated Organization'))
                    ->required(),
            ]),

            Group::make([
                Input::make('farmer_profile.tesda_training_joined')
                    ->title(__('TESDA Training Joined'))
                    ->placeholder(__('TESDA Training Joined'))
                    ->required(),

                Select::make('farmer_profile.nc_passer_status')
                    ->title(__('Is an MC Passer?'))
                    ->options(['Yes', 'No']),
            ]),
        ];
    }
}
