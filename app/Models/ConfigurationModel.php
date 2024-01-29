<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfigurationModel extends Model
{
    use HasFactory;

    protected $table = 'tbl_config_configuration';
    protected $primaryKey = 'id';
    public $timestamps = false; // Assuming you don't want the default created_at and updated_at columns

    protected $fillable = [
        'configuration_id',
        'organization_id',
        'key',
        'value',
        'is_active',
        'created_on',
        'created_by',
        'modified_on',
        'modified_by',
        'is_deleted',
        'deleted_on',
        'deleted_by',
    ];

    public function scopeActiveConfiguration($query)
    {
        return $query->where('is_active', 1)
            ->where('is_deleted', 0)
            ->orderByDesc('created_on');
    }
}