<?php

namespace App\Orchid\Screens\Farmer;

use App\Actions\Batch\DeleteFarmerProfile;
use App\Models\Farmer\FarmerProfile;
use App\Orchid\Layouts\Farmer\FarmerListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

class FarmerListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Farmer Profiles';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'List of all farmers under SM KSK SAP';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'farmer_profiles' => FarmerProfile::with('user')
                ->filters()
                ->defaultSort('id')
                ->paginate(),
        ];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            Link::make(__('Add'))
                ->icon('plus')
                ->route('platform.farmer.profile.create'),
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [
            FarmerListLayout::class,
        ];
    }

    /**
     * Remove a farmer profile.
     * 
     * @param FarmerProfile $farmerProfile
     *
     * @throws \Exception
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(FarmerProfile $farmerProfile)
    {
        return DeleteFarmerProfile::runOrchidAction($farmerProfile, null);
    }
}
