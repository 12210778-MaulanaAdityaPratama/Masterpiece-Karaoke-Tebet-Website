<?php

// routes/web.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\FnbController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
use App\Http\Controllers\Admin\ReservationController as AdminReservationController;

// ── Public ────────────────────────────────────────────────────────────────────
Route::get('/', [HomeController::class, 'index'])->name('home');

// Reservasi
Route::post('/booking', [ReservationController::class, 'submit'])->name('booking.submit');

// Galeri publik (bisa diakses siapa saja)
Route::get('/galeri', [GalleryController::class, 'index'])->name('gallery.index');
Route::post('/galeri/submit', [GalleryController::class, 'submit'])->name('gallery.submit');

// ── Admin ─────────────────────────────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin.timeout'])->group(function () {

    Route::get('/', fn() => redirect()->route('admin.packages.index')); // ← atau packages.index

    // Rooms
    Route::resource('rooms', RoomController::class)->except(['show']);

    // Packages + Tiers
    Route::resource('packages', PackageController::class)->except(['show']);
    Route::prefix('packages/{package}/tiers')->name('packages.tiers.')->group(function () {
        Route::get   ('create',       [PackageController::class, 'createTier'])  ->name('create');
        Route::post  ('/',            [PackageController::class, 'storeTier'])   ->name('store');
        Route::get   ('{tier}/edit',  [PackageController::class, 'editTier'])    ->name('edit');
        Route::put   ('{tier}',       [PackageController::class, 'updateTier'])  ->name('update');
        Route::delete('{tier}',       [PackageController::class, 'destroyTier']) ->name('destroy');
    });

    // F&B
    Route::get   ('fnb/categories',                [FnbController::class, 'categories'])    ->name('fnb.categories');
    Route::post  ('fnb/categories',                [FnbController::class, 'storeCategory']) ->name('fnb.categories.store');
    Route::delete('fnb/categories/{fnbCategory}',  [FnbController::class, 'destroyCategory'])->name('fnb.categories.destroy');

    Route::get   ('fnb/items',                     [FnbController::class, 'items'])         ->name('fnb.items');
    Route::get   ('fnb/items/create',              [FnbController::class, 'createItem'])    ->name('fnb.items.create');
    Route::post  ('fnb/items',                     [FnbController::class, 'storeItem'])     ->name('fnb.items.store');
    Route::get   ('fnb/items/{fnbItem}/edit',      [FnbController::class, 'editItem'])      ->name('fnb.items.edit');
    Route::put   ('fnb/items/{fnbItem}',           [FnbController::class, 'updateItem'])    ->name('fnb.items.update');
    Route::delete('fnb/items/{fnbItem}',           [FnbController::class, 'destroyItem'])   ->name('fnb.items.destroy');

    // Gallery Admin
    Route::get   ('gallery',                       [AdminGalleryController::class, 'index'])   ->name('gallery.index');
    Route::patch ('gallery/{photo}/approve',       [AdminGalleryController::class, 'approve']) ->name('gallery.approve');
    Route::patch ('gallery/{photo}/reject',        [AdminGalleryController::class, 'reject'])  ->name('gallery.reject');
    Route::delete('gallery/{photo}',               [AdminGalleryController::class, 'destroy']) ->name('gallery.destroy');

    // Reservation Admin
    Route::get   ('reservations',                  [AdminReservationController::class, 'index'])        ->name('reservations.index');
    Route::patch ('reservations/{reservation}/status', [AdminReservationController::class, 'updateStatus']) ->name('reservations.updateStatus');
    Route::delete('reservations/{reservation}',    [AdminReservationController::class, 'destroy'])      ->name('reservations.destroy');
});

require __DIR__ . '/auth.php';