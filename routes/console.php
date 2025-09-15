<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;


Schedule::command('reminders:pickup')->everyMinute();
Schedule::command('job:apply-penalty')->everyMinute();
Schedule::command('send:due-reminder')->everyMinute();
Schedule::command('reservations:auto-cancel')->everyMinute();

