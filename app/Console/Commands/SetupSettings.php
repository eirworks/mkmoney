<?php

namespace App\Console\Commands;

use App\Lib\SiteSettings;
use Illuminate\Console\Command;

class SetupSettings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'install:settings';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup default values of site settings';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $settings = SiteSettings::settings();

        collect($settings)->each(function($setting) {
            setting([$setting['key'] => $setting['default']]);
        });
        setting()->save();

        $this->info("Default settings are set");

        return 0;
    }
}
