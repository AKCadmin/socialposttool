<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Crypt;
use App\Models\ConfigurationModel;
use App\Models\OrganizationMasterModel;
use Carbon\Carbon;

use function PHPUnit\Framework\isNull;

class ConfigurationController extends Controller
{
    /*
    * configuration list view
    * Developed By: Sinjan Chakraborty
    * Date: 20th January, 2024
    */
    public function index()
    {
        $data = [
            "module_name" => "configuration",
            "page_title" => "configuration list",
            "form_name" => "configuration table"
        ];
        try {
            //? getting all data where is_active=1 and order by id desc
            $activeConfiguration = ConfigurationModel::join('tbl_master_organization', 'tbl_config_configuration.organization_id', '=', 'tbl_master_organization.organization_id')
                ->select('tbl_config_configuration.id', 'tbl_config_configuration.configuration_id', 'tbl_master_organization.organization_name', 'tbl_config_configuration.key', 'tbl_config_configuration.value')
                ->where('tbl_config_configuration.is_active', 1)
                ->where('tbl_config_configuration.is_deleted', 0)
                ->get();

            // Encrypt organization_id for all rows
            $activeConfiguration->transform(function ($configuration) {
                $configuration->encrypted_id = Crypt::encryptString($configuration->id);
                return $configuration;
            });
            // dd($activeOrganizations);
            $data['data'] = $activeConfiguration;

            return view('content.pages.masters.configuration.configuration-list', compact('data'));
        } catch (\Throwable $err) {
            return "An error occured: " . $err->getMessage();
        }
    }
    /*
    * configuration Add and edit form view
    * Developed By: Sinjan Chakraborty
    * Date: 20th January, 2024
    */
    public function add_configuration_view(Request $request)
    {
        $data = [
            "module_name" => "configuration",
            "page_title" => "add new configuration",
            "form_name" => "configuration form"
        ];

        $organization = OrganizationMasterModel::where('is_active', 1)
            ->orderBy('organization_name', 'asc')
            ->get(['organization_id', 'organization_name']);

        if ($organization) {
            $data["organization_drop_down_data"] = $organization;
        }

        if ($request->query('configuration_id') != "") {
            $configuration_id = $request->query('configuration_id');
            //* decrypting organization_id
            $decrypted_configuration_id = Crypt::decryptString($configuration_id);
            //* geeting organization by organization_id
            try {
                $configuration = ConfigurationModel::find($decrypted_configuration_id);
                //? checking organization found or not
                if ($configuration) {
                    // Encrypt organization_id for all rows
                    // $organization['organization_id'] = (string)$organization_id;
                    // dd($organization['organization_id']);
                    $data['data'] = $configuration;
                }
                return view('content.pages.masters.configuration.configuration-add', compact('data'));
            } catch (\Throwable $err) {
                return "An error occured: " . $err->getMessage();
            }
        } else {
            return view('content.pages.masters.configuration.configuration-add', compact('data'));
        }
    }

    /*
    * Organization Add and edit Action
    * Developed By: Sinjan Chakraborty
    * Date: 19th January, 2024
    */
    public function create_edit_configuration(Request $request)
    {
        $data = [
            "module_name" => "configuration",
            "page_title" => "add new configuration",
            "form_name" => "configuration form"
        ];
        //? taking input from form post
        $id = $request->input('id');
        $key = $request->input('key');
        $value = $request->input('value');
        $organization_id = $request->input('organization_id');
        $configuration_id = null;

        try {
            if ($id != null || $id != "") {
                //? Find the configuartion by its ID
                $configuartion = ConfigurationModel::find($id);
                if ($configuartion) {
                    $configuartion_update = null;
                    //? Update the configuartion's data

                    if (!isNull($organization_id) && ($organization_id !== "null" || $organization_id != null)) {
                        $configuartion_update = $configuartion->update([
                            'key' => $key,
                            'value'   => $value,
                            'organization_id'   => $organization_id,
                            'modified_on' => now(),
                        ]);
                    } else {
                        $configuartion_update = $configuartion->update([
                            'key' => $key,
                            'value'   => $value,
                            'modified_on' => now(),
                        ]);
                    }
                    //? checking actually updated or not
                    if ($configuartion_update) {
                        $data["message"] = "Configuartion Updated Successfully.";
                        $data["error"] = false;
                    } else {
                        $data["message"] = "Failed to Updated Configuartion.";
                        $data["error"] = true;
                    }
                } else {
                    $data["message"] = "Configuartion Not Found.";
                    $data["error"] = true;
                }
            } else {
                //* final code generating
                $configuration_id = "CONF_" . $organization_id . "_" . Carbon::now()->format('U');
                $configuartion = ConfigurationModel::create([
                    'key' => $key,
                    'value'   => $value,
                    'organization_id'   => $organization_id,
                    'configuration_id'   => $configuration_id,
                    'created_on'   =>   now(),
                ]);
                //? checking actually inserted or not
                if ($configuartion->wasRecentlyCreated) {
                    $data["message"] = "Configuartion Inserted Successfully.";
                    $data["error"] = false;
                } else {
                    $data["message"] = "Failed to Insert Configuartion.";
                    $data["error"] = true;
                }
            }
            return view('content.pages.masters.configuration.configuration-add', compact('data'));
        } catch (\Exception  $err) {
            return "An error occured: " . $err->getMessage();
        }
    }
}