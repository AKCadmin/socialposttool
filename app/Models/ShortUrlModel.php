<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShortUrlModel extends Model
{
  use HasFactory;
  protected $table = 'short_urls';
  protected $primaryKey = 'id';
  public $timestamps = false; // Assuming you don't want the default created_at and updated_at columns

  protected $fillable = [
    'destination_url',
    'url_key',
    'default_short_url',
    'single_use',
    'forward_query_params',
    'track_visits',
    'redirect_status_code',
    'track_ip_address',
    'track_operating_system',
    'track_operating_system_version',
    'track_browser',
    'track_referer_url',
    'track_device_type',
    'activated_at',
    'deactivated_at',
    'created_at',
    'updated_at',
  ];
}