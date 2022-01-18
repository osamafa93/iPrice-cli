<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;

class UppercaseCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'converts';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Converts the string to uppercase, alternate upper and lower case, and create a CSV file';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        
        //Read line from user input
        $a = readline('Enter a string: ');
        //
        $UpperLowerSwitch = true;
        
        //Display the output in uppercase
        echo "Output in uppercase: " , strtoupper($a). PHP_EOL;
        //Display text before excute the string
        echo "Output in alternate upper and lower case: ";
        

        //foreach and if else to check each char of the string
        $chars = str_split($a);
        foreach($chars as $char){
            if ($UpperLowerSwitch){
                
                echo strtolower($char);
                $UpperLowerSwitch = false;
            }else {
                echo strtoupper($char);
                $UpperLowerSwitch = true;
            }
        }

        //Remove the last character of the string and save the string to CSV file
        $list = str_split($a);
        $last = array_pop($list);
        $list = array_map(
        function($char) { return "$char,"; },
        $list
        );
        $list[] = $last;
        $list = [$list];
       
        
        $fp = fopen('file.csv', 'w');
        foreach ($list as $fields) {
            fputcsv($fp, $fields);
        }
        fclose($fp);
        echo PHP_EOL . "CSV created!";
    }

    /**
     * Define the command's schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    public function schedule(Schedule $schedule): void
    {
        // $schedule->command(static::class)->everyMinute();
    }
}
