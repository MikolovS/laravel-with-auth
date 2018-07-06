<?php
declare( strict_types = 1 );

namespace App\Http\Controllers\Instagram;

use App\Http\Controllers\Controller;
use App\Models\Instagram\InstaAccount;
use App\Services\Instagram\InstaService;

/**
 * Class InstagramController
 * @package App\Http\Controllers\Instagram
 */
class InstagramController extends Controller
{
	protected $instaService;

	/**
	 * InstagramController constructor.
	 * @param InstaService $instaService
	 */
	public function __construct (InstaService $instaService)
    {
    	$this->instaService = $instaService;
    }

    public function getFeed()
    {
    	$isntaAccount = InstaAccount::first();

    	$feed = $this->instaService->getFeed($isntaAccount);

    	dd($feed);
    }

	public function post()
	{
	    $this->instaService->post();
	}
}
