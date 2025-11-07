<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AStatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Revenue', '$192.10k'),
            Stat::make('New Customers', '1.34k'),
            Stat::make('New Orders', '3.54k'),
        ];
    }
}
