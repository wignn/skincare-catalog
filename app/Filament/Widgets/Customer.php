<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class Customer extends ChartWidget
{
    protected ?string $heading = 'Total Customers';

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Customers',
                    'data' => [0, 10, 15, 22, 28, 32, 45, 70, 85, 95, 100, 106],
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
