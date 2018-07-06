<?php
declare( strict_types = 1 );

namespace App\Services\Instagram;

use App\Clients\InstaClient;
use App\Models\Instagram\InstaAccount;
use Illuminate\Support\Collection;
use InstagramAPI\Instagram;

/**
 * Class InstaFeed
 * @package App\Services\Instagram
 */
class InstaService
{
	/**
	 * sleep time
	 */
	const SLEEP = 1;

	/**
	 * Get account feed
	 *
	 * @param Instagram $instaClient InstaClient
	 * @param           $account     InstaAccount
	 * @return \Illuminate\Support\Collection
	 */
	protected function getUserFeed (Instagram $instaClient, InstaAccount $account)
	{
		# Starting at "null" means starting at the first page.
		$maxId = null;
		$items = collect();

		# Get the UserPK ID from name.
		$userId = $instaClient->people->getUserIdForName($account->name);
		do {
			# Request the page corresponding to maxId.
			$response = $instaClient->timeline->getUserFeed($userId, $maxId);
			# In this example we're simply printing the IDs of this page's items.
			$items = $items->merge($response->getItems());
			# Now we must update the maxId variable to the "next page".
			# This will be a null value again when we've reached the last page!
			# And we will stop looping through pages as soon as maxId becomes null.
			$maxId = $response->getNextMaxId();
			# Sleep for 1 seconds before requesting the next page.
			# It is very important that your scripts
			# always pause between requests that may run very rapidly, otherwise
			# Instagram will throttle you temporarily for abusing their API!
			sleep(self::SLEEP);
		} while ($maxId !== null); # Must use "!==" for comparison instead of "!=".

		return $items;
	}

	/**
	 * @param InstaAccount $instaAccount
	 * @return \Illuminate\Support\Collection
	 */
	public function getFeed (InstaAccount $instaAccount) : Collection
	{
		$instaClient = InstaClient::make();

		return $this->getUserFeed($instaClient, $instaAccount);
	}

	public  function post()
	{
		$instaClient = InstaClient::make();

		$photo = new \InstagramAPI\Media\Photo\InstagramPhoto(storage_path('test.jpg'));

		$instaClient->timeline->uploadPhoto($photo->getFile(), ['caption' => '']);
	}
}