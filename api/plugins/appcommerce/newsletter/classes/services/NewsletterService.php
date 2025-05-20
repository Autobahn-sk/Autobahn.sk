<?php namespace AppCommerce\Newsletter\Classes\Services;

use Exception;
use Mailjet\Client;
use Mailjet\Resources;
use AppUtil\Logger\Classes\Logger;
use October\Rain\Support\Facades\Event;
use Illuminate\Support\Facades\Validator;
use October\Rain\Exception\ValidationException;

class NewsletterService
{
	/**
	 * Subscribe a user to the newsletter.
	 *
	 * @param string $email
	 * @return bool
	 * @throws ValidationException
	 */
    public static function subscribe(string $email): bool
    {
        $params = [
            'email' => $email
        ];

        $validation = Validator::make($params, [
            'email' => 'email|required'
        ]);

        if ($validation->fails()) {
            throw new ValidationException($validation);
        }

        Event::fire('appcommerce.newsletter.beforeSubscribe', [$email]);

        try {
            $mj = new Client(env('MJ_APIKEY_PUBLIC'), env('MJ_APIKEY_PRIVATE'),true, [
                'version' => 'v3'
            ]);

            $body = [
                'Action' => 'addforce',
                'Email'  => $email
            ];

            $mj->post(Resources::$ContactslistManagecontact, [
                'id'   => env('MJ_CONTACT_LIST_ID'),
                'body' => $body
            ]);

            $isSubscribed = true;

			Logger::info("NewsletterService - subscribe: $email");
		}
        catch (Exception $exception) {
            $isSubscribed = false;

            Logger::error("NewsletterService - subscribe: $email - " . $exception->getMessage(), $exception);
        }

		Event::fire('appcommerce.newsletter.afterSubscribe', [$email]);

        return $isSubscribed;
    }

	/**
	 * @param string $email
	 * @return bool
	 * @throws ValidationException
	 */
    public static function unsubscribe(string $email): bool
    {
        $params = [
            'email' => $email
        ];

        $validation = Validator::make($params, [
            'email' => 'email|required'
        ]);

        if ($validation->fails()) {
            throw new ValidationException($validation);
        }

        Event::fire('appcommerce.newsletter.beforeUnsubscribe', [$email]);

        try {
            $mj = new Client(env('MJ_APIKEY_PUBLIC'), env('MJ_APIKEY_PRIVATE'),true, [
                'version' => 'v3'
            ]);

            $body = [
                'Action' => 'unsub',
                'Email'  => $email
            ];

            $mj->post(Resources::$ContactslistManagecontact, [
                'id'   => env('MJ_CONTACT_LIST_ID'),
                'body' => $body
            ]);

            $isUnsubscribed = true;

			Logger::info("NewsletterService - unsubscribe: $email");
        }
        catch (Exception $exception) {
            $isUnsubscribed = false;

			Logger::error("NewsletterService - unsubscribe: $email - " . $exception->getMessage(), $exception);
        }

        Event::fire('appcommerce.newsletter.afterUnsubscribe', [$email]);

        return $isUnsubscribed;
    }
}
