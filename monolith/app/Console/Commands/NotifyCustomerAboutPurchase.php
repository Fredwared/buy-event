<?php

namespace App\Console\Commands;

use App\Constants\ChannelConstants;
use App\Events\NotifyPurchaseEvent;
use App\Services\UserService;
use Illuminate\Console\Command;

class NotifyCustomerAboutPurchase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:purchase';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /** @var UserService $userService */
    protected $userService;


    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->userService = app(UserService::class);
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $customerEmail = $this->ask('Tell me about customer! Hint his email');

        $customer = $this->userService->findUser($customerEmail, 'email');

        if(!$customer){
            echo "Whoops sorry '{$customerEmail}' doest match our record! You can try again.";
            $this->handle();
        }

        $order = $this->choice(
            'Select which order you would like notify about!',
            $customer->orders->pluck('id')->toArray(),
        );

        $channel = $this->choice(
            'Which channel do you want to send?',
            [ChannelConstants::SMS, ChannelConstants::MAIL],
        );

        NotifyPurchaseEvent::dispatch($order, $channel);

        return 'Okay we executed the notification process, details you can see in logs';
    }
}
