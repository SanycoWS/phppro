<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ProblemCode extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:problem-code';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        /**  */
        if (file_exists('./file.txt')) {
            $this->info(file_get_contents('./file.txt'));
        } else {
            $this->error("Файлу не існує! ");
        }

        if (file_exists('./file.txt') === false) {
            $this->error("Файлу не існує! ");

            return;
        }
        $this->info(file_get_contents('./file.txt'));

        /**  */
        if (is_numeric($age) === false) {
            $this->error('Invalid age entered');

            return;
        }

        if ($age < 18 && $this->confirm('Do you want to continue?') === false) {
            return;
        }

        /**  */
        if ($fileSaving === true) {
            $this->info('successfull');

            return;
        }

        /**  */
        if (file_exists($file) === false) {
            $content = file_get_contents($file);
            $this->info($content);
        } else {
            $this->error('Файл не існує');
        }

        /**  */
        if (file_put_contents($file, $jsonData) === false) {
            $this->error('Failed to write data to file');

            return;
        }

        $this->info('Data successfully written to file');

        /**  */
        if ($this->ask("Скільки тобі років {$user_data['name']}?") < 18) {
            if ($this->confirm("Ви бажаете продовжити?") === false) {
                $this->error("Бай бай!");

                return;
            }
        }

        /**  */
        if (is_numeric($age) === false) {
            echo 'error';

            return;
        }
        // all big code
    }
}
