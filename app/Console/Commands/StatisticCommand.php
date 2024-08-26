<?php

namespace App\Console\Commands;

use App\Contracts\Services\StatisticsServiceContract;
use Illuminate\Console\Command;

class StatisticCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:statistics';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Команда показывает статистику сайта';

    /**
     * Execute the console command.
     */
    public function handle(StatisticsServiceContract $statisticsService)
    {
        $result = $statisticsService->getResultArray();

        $this->table(['Показатель', 'Дополнительный показатель', 'Дополнительный показатель'], $result);
    }
}
