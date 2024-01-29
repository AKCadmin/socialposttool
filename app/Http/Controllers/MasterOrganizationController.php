<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\OrganizationMasterModel;
use Illuminate\Support\Facades\Crypt;

class MasterOrganizationController extends Controller
{
    /*
    * Organization list view
    * Developed By: Sinjan Chakraborty
    * Date: 19th January, 2024
    */
    public function index()
    {
        $data = [
            "module_name" => "organization",
            "page_title" => "organization list",
            "form_name" => "organization table"
        ];
        try {
            //? getting all data where is_active=1 and order by id desc
            $activeOrganizations = OrganizationMasterModel::activeOrganizations()->get();
            // Encrypt organization_id for all rows
            $activeOrganizations->transform(function ($organization) {
                $organization->encrypted_organization_id = Crypt::encryptString($organization->organization_id);
                return $organization;
            });
            // dd($activeOrganizations);
            $data['data'] = $activeOrganizations;

            return view('content.pages.masters.organization.organization-list', compact('data'));
        } catch (\Throwable $err) {
            return "An error occured: " . $err->getMessage();
        }
    }
    /*
    * Organization Add and edit form view
    * Developed By: Sinjan Chakraborty
    * Date: 19th January, 2024
    */
    public function add_organization_view(Request $request)
    {
        $data = [
            "module_name" => "organization",
            "page_title" => "add new organization",
            "form_name" => "organization form"
        ];

        if ($request->query('organization_id') != "") {
            $organization_id = $request->query('organization_id');
            //* decrypting organization_id
            $decrypted_organization_id = Crypt::decryptString($organization_id);
            //* geeting organization by organization_id
            try {
                $organization = OrganizationMasterModel::find($decrypted_organization_id);
                //? checking organization found or not
                if ($organization) {
                    // Encrypt organization_id for all rows
                    // $organization['organization_id'] = (string)$organization_id;
                    // dd($organization['organization_id']);
                    $data['data'] = $organization;
                }
                return view('content.pages.masters.organization.organization-add', compact('data'));
            } catch (\Throwable $err) {
                return "An error occured: " . $err->getMessage();
            }
        } else {
            return view('content.pages.masters.organization.organization-add', compact('data'));
        }
    }

    /*
    * Organization Add and edit Action
    * Developed By: Sinjan Chakraborty
    * Date: 19th January, 2024
    */
    public function create_edit_organization(Request $request)
    {
        $data = [
            "module_name" => "organization",
            "page_title" => "add new organization",
            "form_name" => "organization form"
        ];
        //? taking input from form post
        $organization_id = $request->input('organization_id');
        $organization_name = $request->input('organization_name');
        $organization_type = $request->input('organization_type');
        //* initialization
        $is_social_media = null;
        $is_market_place = null;
        //? checking organization_type based on radio button value
        if ($organization_type === 'is_social_media') {
            $is_social_media = 1;
        } else {
            $is_market_place = 1;
        }
        //? auto generation of organization_code
        $organization_code = "ORG";
        if ($is_social_media == 1) {
            $organization_code .= "S_";
        } else {
            $organization_code .= "M_";
        }
        //* final code will be like ORGS_<CURRENTDATE> or ORGM_<CURRENTDATE>
        $organization_code .= Carbon::now()->format('U');
        try {
            if ($organization_id != null || $organization_id != "") {
                //? Find the organization by its ID
                $organization = OrganizationMasterModel::find($organization_id);
                if ($organization) {
                    //? Update the organization's data
                    $organization_update = $organization->update([
                        'organization_name' => $organization_name,
                        'is_social_media'   => $is_social_media,
                        'is_market_place'   => $is_market_place,
                    ]);
                    //? checking actually updated or not
                    if ($organization_update) {
                        $data["message"] = "Organization Updated Successfully.";
                        $data["error"] = false;
                    } else {
                        $data["message"] = "Failed to Updated Organization.";
                        $data["error"] = true;
                    }
                } else {
                    $data["message"] = "Organization Not Found.";
                    $data["error"] = true;
                }
            } else {
                $organization = OrganizationMasterModel::create([
                    'organization_code' => $organization_code,
                    'organization_name' => $organization_name,
                    'is_social_media'   => $is_social_media,
                    'is_market_place'   => $is_market_place,
                ]);
                //? checking actually inserted or not
                if ($organization->wasRecentlyCreated) {
                    $data["message"] = "Organization Inserted Successfully.";
                    $data["error"] = false;
                } else {
                    $data["message"] = "Failed to Insert Organization.";
                    $data["error"] = true;
                }
            }
            return view('content.pages.masters.organization.organization-add', compact('data'));
        } catch (\Exception  $err) {
            return "An error occured: " . $err->getMessage();
        }
    }
}