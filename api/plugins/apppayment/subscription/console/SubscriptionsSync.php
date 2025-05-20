<?php namespace AppPayment\Subscription\Console;

use Exception;
use Illuminate\Console\Command;
use AppPayment\Subscription\Classes\SubscriptionCronUpdater;

class SubscriptionsSync extends Command
{
    /**
     * @var string The console command name.
     */
    protected $name = 'subscriptions:sync';

    /**
     * @var string The console command description.
     */
    protected $description = 'No description provided yet...';

	/**
	 * Execute the console command.
	 *
	 * @return void
	 * @throws Exception
	 */
    public function handle(): void
	{
		try {
			(new SubscriptionCronUpdater())->checkAllSubscriptions();
			$this->output->success('Sync was successful.');
		} catch (Exception $e) {
			$this->output->error('Sync failed: ' . $e->getMessage());
			throw $e;
		}
    }

    /**
     * Get the console command arguments.
	 *
     * @return array
     */
    protected function getArguments(): array
	{
        return [];
    }

    /**
     * Get the console command options.
	 *
     * @return array
     */
    protected function getOptions(): array
	{
        return [];
    }
}
