<?php

namespace App\Console\Commands;

use App\Extensions\IMAPSync\IMAPClient;
use Illuminate\Console\Command;

class Fetch extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';


    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $t = new IMAPClient();
        $mails = $t->fetchMails();
        foreach ($mails as $mail) {
            $t->processMail($mail);
        }
        return Command::SUCCESS;
    }
}
