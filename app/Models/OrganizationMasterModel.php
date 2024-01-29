<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationMasterModel extends Model
{
    use HasFactory;

    protected $table = 'tbl_master_organization';
    protected $primaryKey = 'organization_id';
    public $timestamps = false; // Assuming you don't want the default created_at and updated_at columns

    protected $fillable = [
        'organization_code',
        'organization_name',
        'is_social_media',
        'is_market_place',
        'is_active'
    ];

    public function scopeActiveOrganizations($query)
    {
        return $query->where('is_active', 1)
            ->orderByDesc('organization_id');
    }
}