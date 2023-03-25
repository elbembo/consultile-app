<?php

namespace App\Http\Controllers\Domains\Subscribe;

use App\Exports\SubscriberExport;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use Exception;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class HomeController extends Controller
{
    //
    public function index()
    {
        # code...
        $contacts = Contact::where('source','Subscribr form')->orderBy('contacts.id', 'desc')->paginate(30);
        return view('domains.subscribe.index',compact('contacts'));
    }
    public function home()
    {
        # code...
        return view('domains.subscribe.home');
    }
    public function store (Request $request)
    {
        $list_id = env('MAILCHIMP_LIST_ID');
        $mailchimp = new \MailchimpMarketing\ApiClient();
        $mailchimp->setConfig([
            'apiKey' => env('MAILCHIMP_APIKEY'),
            'server' => env('MAILCHIMP_SERVER')
        ]);

					try {
						$response = $mailchimp->lists->addListMember($list_id, [
							"email_address" => $request->email,
							"status" => "subscribed",
							"merge_fields" => [
								"FNAME" => $request->first_name,
								"LNAME" => $request->last_name
							]
						]);
						//error_log($response);
					} catch (Exception $e) {
						//$err =  true;
						//print_r($e);
					}
					$subscriber_hash = md5(strtolower($request->email));

					try {
						$mailchimp->lists->updateListMemberTags($list_id, $subscriber_hash, [
							"tags" => [
								[
									"name" => "Newsletter",
									"status" => "active"
								]
							]
						]);
					} catch (Exception $e) {
						$err = true;
						//print_r($e);
					}
        $data = request()->except(['_token']);
        Contact::firstOrCreate($data);
        return back()->withErrors(['msg' => 'The Message']);
    }
    public function export()
    {
        # code...
        return Excel::download(new SubscriberExport, 'All_subscriber.consultile.com.xlsx');
    }
}
