<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ConfigurationModel;
use App\Models\OrganizationMasterModel;
use App\Models\ShortUrlModel;
use App\Models\SocialPostModel;
use Illuminate\Support\Facades\Http;
use Abraham\TwitterOAuth\TwitterOAuth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;

require_once base_path('app/apihandler.php');
require_once base_path('app/vendor/autoload.php');

class SocialPostController extends Controller
{
    /*
   * social post list view
   * Developed By: Sinjan Chakraborty
   * Date: 20th January, 2024
   */
    public function index()
    {
        $data = [
            'module_name' => 'social post',
            'page_title' => 'social post list',
            'form_name' => 'social post table',
        ];
        try {
            //? getting all data where is_active=1 and order by id desc
            $social_post = SocialPostModel::join('short_urls', 'short_urls.id', '=', 'tbl_post.short_url_id')
                ->select('tbl_post.id', 'tbl_post.post_id', 'short_urls.destination_url', 'short_urls.default_short_url', 'tbl_post.post_content_text', 'tbl_post.post_url')
                ->orderByDesc('tbl_post.created_on')
                ->get();

            // Encrypt organization_id for all rows
            $social_post->transform(function ($post) {
                $post->encrypted_id = Crypt::encryptString($post->id);
                return $post;
            });
            // dd($activeOrganizations);
            $data['data'] = $social_post;

            return view('content.pages.posts.social-post-list', compact('data'));
        } catch (\Throwable $err) {
            return "An error occured: " . $err->getMessage();
        }
    }
    /*
   * social post form view
   * Developed By: Sinjan Chakraborty
   * Date: 20th January, 2024
   */
    public function auto_post_view()
    {
        $data = [
            'module_name' => 'social post',
            'page_title' => 'social post add',
            'form_name' => 'social post form',
        ];
        $organization = OrganizationMasterModel::where('is_active', 1)
            ->orderBy('organization_name', 'asc')
            ->get(['organization_id', 'organization_name']);

        if ($organization) {
            $data['organization_drop_down_data'] = $organization;
        }
        return view('content.pages.posts.social-post-add', compact('data'));
    }
    /*
   * social post controller
   * Developed By: Sinjan Chakraborty
   * Date: 20th January, 2024
   */
    public function auto_post_action(Request $request)
    {
        $data = [
            'module_name' => 'social post',
            'page_title' => 'social post add',
            'form_name' => 'social post form',
        ];
        $organization = OrganizationMasterModel::where('is_active', 1)
            ->orderBy('organization_name', 'asc')
            ->get(['organization_id', 'organization_name']);

        if ($organization) {
            $data['organization_drop_down_data'] = $organization;
        }

        //? taking form data and initializing variables with that data
        $aws_paapi_submit = $request->input('aws_paapi_submit');
        $locale = $request->input('locale');
        $search_index = $request->input('search_index');
        $keyword = $request->input('keyword');
        $organization_id = $request->input('organization_id');
        $affiliate_id = $request->input('affiliate_id');
        //! checking aws_paapi_submit has value or not
        if ($aws_paapi_submit == '') {
            return 'An error occured: Security check failed.';
        }
        //? checking organization_id and if not present then select for amazon for now
        if (!$organization_id) {
            $organization_id = 2;
        }
        try {
            //? gettin configuartions for amazon for now
            $configurations = ConfigurationModel::where('organization_id', $organization_id)
                ->select('configuration_id', 'key', 'value')
                ->get();
            $access_key = null;
            $secret_key = null;
            if ($configurations) {
                foreach ($configurations as $configuration) {
                    if ($configuration->key === 'AccessKey') {
                        $access_key = $configuration->value;
                    }
                    if ($configuration->key === 'SecretKey') {
                        $secret_key = $configuration->value;
                    }
                }
            }
            $endpoint = null;
            $marketplace = null;
            $region = null;
            //? getting end point, mrket place and region according to locale
            switch ($locale) {
                case '.com':
                    $endpoint = 'webservices.amazon.com';
                    $marketplace = 'www.amazon.com';
                    $region = 'us-east-1';
                    break;
                case '.sa':
                    $endpoint = 'webservices.amazon.sa';
                    $marketplace = 'www.amazon.sa';
                    $region = 'eu-west-1';
                    break;
                case '.in':
                    $endpoint = 'webservices.amazon.in';
                    $marketplace = 'www.amazon.in';
                    $region = 'us-east-1';
                    break;
                case '.co.uk':
                    $endpoint = 'webservices.amazon.co.uk';
                    $marketplace = 'www.amazon.co.uk';
                    $region = 'eu-west-2';
                    break;
            }

            $api_response = amazon_paapi5_api_handle(
                $access_key,
                $secret_key,
                $region,
                $marketplace,
                $endpoint,
                $affiliate_id,
                $search_index,
                $keyword
            );
            //! twitter configuration
            $consumerKey = 'plRAviurN1YZOUhPAaOO16fTl';
            $consumerSecret = 'Zc1HbP7qWioyzYIZhswY6mtbtmgWdPJDMkuVqTozBmdIW8axGl';
            $accessToken = '1748757996967165952-C4g5B69RIpmedv9v3MKmH6Q1a4n843';
            $accessTokenSecret = 'EjVd7kfM6qUpIRyF7h3tznCmMunXzrKVi932vEG1amsGw';
            if ($api_response) {
                $post_count = 0;
                foreach ($api_response['SearchResult']['Items'] as $item) {
                    $twitterOAuth = new TwitterOAuth($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);
                    $twitterOAuth->setApiVersion(1.1);
                    $twitterOAuth->setTimeouts(10, 15);
                    $title = $item['ItemInfo']['Title']['DisplayValue'];
                    $link = $item['DetailPageURL'];
                    //? library call to generate short url
                    $builder = new \AshAllenDesign\ShortURL\Classes\Builder();
                    $shortURLObject = $builder
                        ->destinationUrl($link)
                        ->trackVisits()
                        ->trackIPAddress()
                        ->secure()
                        ->make();
                    $shortURL = $shortURLObject->default_short_url;
                    $short_url_id = $shortURLObject->id;
                    $imageUrl = $item['Images']['Primary']['Large']['URL'];
                    $imageContent = file_get_contents($imageUrl);
                    // Check if image download is successful
                    if ($imageContent !== false) {
                        // Define the directory path
                        $directory = 'product_images/';
                        // Check if the directory exists, if not, create it with 0777 permissions
                        if (!Storage::exists($directory)) {
                            Storage::makeDirectory($directory, 0777, true); // Recursive = true
                        }
                        // Save image to storage
                        $imagePath = $directory . basename($imageUrl);
                        Storage::put($imagePath, $imageContent);
                        // Get the full local path of the saved image
                        $localPath = storage_path('app/' . $imagePath);
                        // Upload image to Twitter
                        $media = $twitterOAuth->upload('media/upload', ['media' => $localPath]);
                        $twitterOAuth->setApiVersion(2);
                        $parameters = [
                            'text' => $title . ' ' . $shortURL,
                            'media' => ['media_ids' => [$media->media_id_string]],
                        ];
                        // Post tweet
                        $tweet = $twitterOAuth->post('tweets', $parameters, true);
                        Storage::delete($imagePath);
                        if (in_array($twitterOAuth->getLastHttpCode(), [200, 201])) {
                            $post_count++;
                            $string = $tweet->data->text;
                            // Extracting product name
                            preg_match('/^([^\s]+)\s(.+?)\s(http:\/\/[^\s]+)\s(https:\/\/[^\s]+)/', $string, $matches);
                            $product_name = $matches[1];
                            $product_url = $matches[2];
                            $post_url = $matches[3];
                            $post = SocialPostModel::create([
                                'post_id' => $tweet->data->id,
                                'short_url_id' => $short_url_id,
                                'social_media_id' => 1,
                                'post_content_text' => $product_name . " " . $product_url,
                                'is_media_post' => 1,
                                'post_url' => $post_url
                            ]);
                            //? checking actually inserted or not
                            if ($post->wasRecentlyCreated) {
                                $data["message"] = "$post_count Item Posted Successfully.";
                                $data["error"] = false;
                            } else {
                                $data["message"] = "Failed to Post after $post_count post.";
                                $data["error"] = true;
                                return view('content.pages.posts.social-post-add', compact('data'));
                            }
                        } else {
                            // There was an error
                            $data["message"] = "Failed to Post after $post_count post due to" . $twitterOAuth->getLastHttpCode();
                            $data["error"] = true;
                            return view('content.pages.posts.social-post-add', compact('data'));
                        }
                    }
                }
            }
            return view('content.pages.posts.social-post-add', compact('data'));
        } catch (\Exception  $err) {
            $data["message"] = "No product found";
            $data["error"] = true;
            return view('content.pages.posts.social-post-add', compact('data'));
        }
    }
}