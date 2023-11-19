<?php


use App\Http\Controllers\Api\Admin\OfferController;
use Illuminate\Support\Facades\Route;

Route::resource('offers', OfferController::class)->except(['create', 'update']);
