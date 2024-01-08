<?php

namespace App\Filament\Widgets;

use App\Models\Offer;
use App\Models\Order;
use App\Models\User;
use App\Models\WorkerForm;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Users', User::query()->where('is_worker', 0)->count())
            ->chart([20, 25, 35, 15, 40, 30, 17])
            ->color('success'),
            Stat::make('Workers', User::query()->where('is_worker', 1)->count())
            ->chart([37, 24, 52, 19, 45, 30, 58])
            ->color('primary'),
            Stat::make('Workers Applications', WorkerForm::count())
            ->chart([10, 50])
            ->color('primary'),
            Stat::make('Pending Orders', Order::query()->where('status', 'pending')->count())
            ->chart([0,0])
            ->color('danger'),
            Stat::make('Finished Orders', Order::query()->where('status', 'finish')->count())
            ->chart([0,0])
            ->color('danger'),
            Stat::make('Offers', Offer::count())
            ->chart([0,0])
            ->color('danger'),
        ];
    }
}
