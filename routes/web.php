<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SocialPostController;
use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\MasterOrganizationController;

// Main Page Route
Route::get('/', [SocialPostController::class, 'index'])->name('social-posts');
Route::get('/post/post-form', [SocialPostController::class, 'auto_post_view'])->name('do-social-post-view');
Route::post('/post/post-action', [SocialPostController::class, 'auto_post_action'])->name('do-social-post-action');

//? configuration routings
Route::group(['prefix' => 'configuration'], function () {
    Route::get('/list', [ConfigurationController::class, 'index'])->name('configuration-list');
    Route::get('/add', [ConfigurationController::class, 'add_configuration_view'])->name('configuration-add');
    Route::post('/create-or-edit', [ConfigurationController::class, 'create_edit_configuration'])->name('configuration-create-or-edit');
    Route::get('/edit', [ConfigurationController::class, 'add_configuration_view'])->name('configuration-edit');
});

//? organization routings
Route::group(['prefix' => 'organization'], function () {
    Route::get('/list', [MasterOrganizationController::class, 'index'])->name('organization-list');
    Route::get('/add', [MasterOrganizationController::class, 'add_organization_view'])->name('organization-add');
    Route::post('/create-or-edit', [MasterOrganizationController::class, 'create_edit_organization'])->name('organization-create-or-edit');
    Route::get('/edit', [MasterOrganizationController::class, 'add_organization_view'])->name('organization-edit');
});