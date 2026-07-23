<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\FinancialController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicTripController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\WithdrawalController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (Auth::check()) {
        Auth::guard('web')->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
    }

    return view('welcome');
})->name('welcome');

Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['ar', 'en'])) {
        session(['locale' => $locale]);
    }
    return back();
})->name('lang.switch');

Route::get('/trips', function () {
    return redirect()->route('trips.public');
});

Route::get('/dashboard', function () {
    $user = auth()->user();

    if ($user->role === 'office') {
        return redirect()->route('office.dashboard');
    } elseif ($user->role === 'owner') {
        return redirect()->route('owner.dashboard');
    } elseif ($user->role === 'admin') {
        return redirect()->route('owner.offices');
    }

    return redirect()->route('user.dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/trips', [PublicTripController::class, 'index'])->name('trips.public');

Route::middleware('auth')->group(function () {

    // User Dashboard
    Route::get('/user/dashboard', function () {
        return view('user.dashboard');
    })->name('user.dashboard');

    // User Points
    Route::get('/user/points', [\App\Http\Controllers\PointsController::class, 'index'])->name('user.points');

    // Office Dashboard
    Route::get('/office/dashboard', function () {
        $user = auth()->user();
        $tripIds = App\Models\Trip::where('user_id', $user->id)->pluck('id');
        $stats = [
            'trips' => $tripIds->count(),
            'bookings' => App\Models\Booking::whereIn('trip_id', $tripIds)->count(),
            'avg_rating' => App\Models\Rating::whereIn('trip_id', $tripIds)->avg('rating') ?? 0,
        ];
        return view('office.dashboard', compact('stats'));
    })->middleware('role:office')->name('office.dashboard');

    // Owner Dashboard
    Route::get('/owner/dashboard', [AdminController::class, 'index'])->middleware('role:owner')->name('owner.dashboard');

    // Owner + Admin shared routes (user creation)
    Route::middleware('role:owner,admin')->group(function () {
        Route::get('/owner/users/create/{role}', [AdminController::class, 'createUser'])->name('owner.users.create');
        Route::post('/owner/users/create', [AdminController::class, 'storeUser'])->name('owner.users.store');
    });

    // Owner-only routes
    Route::middleware('role:owner')->group(function () {
        Route::get('/owner/users', [AdminController::class, 'users'])->name('owner.users');

        Route::get('/owner/trips', [AdminController::class, 'trips'])->name('owner.trips');
        Route::get('/owner/bookings', [AdminController::class, 'bookings'])->name('owner.bookings');
        Route::delete('/owner/users/{user}', [AdminController::class, 'destroyUser'])->name('owner.users.destroy');
        Route::patch('/owner/users/{user}/pause', [AdminController::class, 'togglePauseUser'])->name('owner.users.pause');

        Route::patch('/owner/trips/{trip}/pause', [AdminController::class, 'togglePause'])->name('owner.trips.pause');
        Route::patch('/owner/trips/{trip}/cancel', [AdminController::class, 'cancelTrip'])->name('owner.trips.cancel');
        Route::patch('/owner/trips/{trip}/reopen', [AdminController::class, 'reopenTrip'])->name('owner.trips.reopen');
        Route::delete('/owner/trips/{trip}', [AdminController::class, 'destroyTrip'])->name('owner.trips.destroy');

        Route::delete('/owner/offices/{user}', [AdminController::class, 'destroyUser'])->name('owner.offices.destroy');
        Route::patch('/owner/offices/{user}/pause', [AdminController::class, 'togglePauseUser'])->name('owner.offices.pause');
        Route::patch('/owner/offices/{user}/discount', [AdminController::class, 'updateOfficeDiscount'])->name('owner.offices.discount');

        // Export routes
        Route::get('/owner/export/trips', [App\Http\Controllers\ExportController::class, 'trips'])->name('owner.export.trips');
        Route::get('/owner/export/bookings', [App\Http\Controllers\ExportController::class, 'bookings'])->name('owner.export.bookings');
        Route::get('/owner/export/offices', [App\Http\Controllers\ExportController::class, 'offices'])->name('owner.export.offices');
        Route::get('/owner/export/users', [App\Http\Controllers\ExportController::class, 'users'])->name('owner.export.users');
        Route::get('/owner/export/office-requests', [App\Http\Controllers\ExportController::class, 'officeRequests'])->name('owner.export.office-requests');

        // Financial overview (Owner)
        Route::get('/owner/financials', [FinancialController::class, 'ownerIndex'])->name('owner.financials');

        // Withdrawal management (Owner)
        Route::get('/owner/withdrawals', [WithdrawalController::class, 'ownerIndex'])->name('owner.withdrawals');
        Route::patch('/owner/withdrawals/{withdrawalRequest}/process', [WithdrawalController::class, 'startProcessing'])->name('owner.withdrawals.process');
        Route::patch('/owner/withdrawals/{withdrawalRequest}/complete', [WithdrawalController::class, 'complete'])->name('owner.withdrawals.complete');
        Route::patch('/owner/withdrawals/{withdrawalRequest}/reject', [WithdrawalController::class, 'reject'])->name('owner.withdrawals.reject');
    });

    // Global discount (owner only)
    Route::post('/owner/settings/global-discount', [AdminController::class, 'updateGlobalDiscount'])
        ->middleware('role:owner')->name('owner.settings.global-discount');

    // Owner + Admin shared routes (offices only, read-only)
    Route::middleware('role:owner,admin')->group(function () {
        Route::redirect('/owner', '/owner/offices');
        Route::get('/owner/offices', [AdminController::class, 'offices'])->name('owner.offices');
    });

    // Office registration requests (Owner + Admin)
    Route::middleware('role:owner,admin')->group(function () {
        Route::get('/owner/office-requests', function () {
            $requests = \App\Models\OfficeRegistrationRequest::latest()->paginate(20);
            return view('owner.office-requests', compact('requests'));
        })->name('owner.office.requests');

        Route::patch('/owner/office-requests/{officeRegistrationRequest}/approve', function (\App\Models\OfficeRegistrationRequest $officeRegistrationRequest) {
            $officeRegistrationRequest->update(['status' => 'approved']);
            return redirect()->back()->with('success', 'Request approved');
        })->name('owner.office.requests.approve');

        // Office deletion requests (Owner + Admin)
        Route::get('/owner/deletion-requests', function () {
            $requests = \App\Models\OfficeDeletionRequest::latest()->paginate(20);
            return view('owner.deletion-requests', compact('requests'));
        })->name('owner.deletion.requests');

        Route::patch('/owner/deletion-requests/{officeDeletionRequest}/approve', function (\App\Models\OfficeDeletionRequest $officeDeletionRequest) {
            $user = $officeDeletionRequest->user;
            if ($user) {
                $user->delete();
            }
            $officeDeletionRequest->update(['status' => 'approved']);
            return redirect()->back()->with('success', 'Office account deleted successfully');
        })->name('owner.deletion.requests.approve');

        Route::patch('/owner/deletion-requests/{officeDeletionRequest}/reject', function (\App\Models\OfficeDeletionRequest $officeDeletionRequest) {
            $officeDeletionRequest->update(['status' => 'rejected']);
            return redirect()->back()->with('success', 'Deletion request rejected');
        })->name('owner.deletion.requests.reject');
    });

    // Impersonate user (Owner + Admin)
    Route::middleware('role:owner,admin')->group(function () {
        Route::get('/owner/users/{user}/impersonate', function (\App\Models\User $user) {
            session()->put('impersonator', auth()->id());
            session()->put('impersonator_previous_url', url()->previous());
            auth()->login($user);
            return redirect()->route('dashboard');
        })->name('owner.users.impersonate');
    });

    // Leave impersonation (outside role middleware — accessible while logged in as any user)
    Route::get('/owner/leave-impersonation', function () {
        if (!session()->has('impersonator')) {
            abort(403);
        }
        $originalId = session()->pull('impersonator');
        $previousUrl = session()->pull('impersonator_previous_url');
        if ($originalId) {
            auth()->loginUsingId($originalId);
        }
        return redirect($previousUrl ?? route('owner.users'));
    })->name('owner.leave.impersonation');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Office deletion request
    Route::post('/profile/deletion-request', function (\Illuminate\Http\Request $request) {
        $user = auth()->user();
        if ($user->role !== 'office') {
            abort(403);
        }

        \App\Models\OfficeDeletionRequest::create([
            'user_id' => $user->id,
            'office_name' => $user->name,
            'email' => $user->email,
            'num1' => $user->num1,
            'num2' => $user->num2,
        ]);

        return redirect()->back()->with('status', 'deletion-requested');
    })->middleware('auth')->name('profile.deletion.request');

    // Booking routes (User)
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::post('/trips/{trip}/book', [BookingController::class, 'store'])->name('bookings.store');
    Route::delete('/bookings/{booking}', [BookingController::class, 'destroy'])->name('bookings.destroy');
    Route::post('/bookings/{booking}/resend-ticket', [BookingController::class, 'resendTicket'])->name('bookings.resend-ticket');

    // Payment routes
    Route::get('/payment/{trip}', [PaymentController::class, 'create'])->name('payment.create');
    Route::post('/payment/process', [PaymentController::class, 'process'])->name('payment.process');
    Route::post('/payment/callback', [PaymentController::class, 'callback'])->name('payment.callback');

    // Rating routes
    Route::post('/trips/{trip}/rate', [\App\Http\Controllers\RatingController::class, 'store'])->name('ratings.store');

    // Offices routes
    Route::get('/offices', [\App\Http\Controllers\OfficeController::class, 'index'])->name('offices.index');
    Route::get('/offices/{office}', [\App\Http\Controllers\OfficeController::class, 'show'])->name('offices.show');

    // Trips CRUD (Office only)
    Route::middleware('role:office')->group(function () {
        Route::get('/office/trips', [TripController::class, 'index'])->name('office.trips.index');
        Route::get('/trips/create-multi', [TripController::class, 'createMulti'])->name('trips.create.multi');
        Route::post('/trips/store-multi', [TripController::class, 'storeMulti'])->name('trips.store.multi');
        Route::get('/trips/{trip}/edit', [TripController::class, 'edit'])->name('trips.edit');
        Route::put('/trips/{trip}', [TripController::class, 'update'])->name('trips.update');
        Route::post('/trips/{trip}/image', [TripController::class, 'uploadImage'])->name('trips.image.upload');
        Route::delete('/trips/{trip}', [TripController::class, 'destroy'])->name('trips.destroy');
        Route::patch('/trips/{trip}/cancel', [TripController::class, 'cancel'])->name('trips.cancel');

        // Trip bookings (Office)
        Route::get('/office/trips/{trip}/bookings', [BookingController::class, 'tripBookings'])->name('office.trip.bookings');

        // All office bookings
        Route::get('/office/bookings', function () {
            $tripIds = App\Models\Trip::where('user_id', auth()->id())->pluck('id');
            $bookings = App\Models\Booking::with(['trip', 'user'])
                ->whereIn('trip_id', $tripIds)
                ->orderBy('created_at', 'desc')
                ->paginate(15);
            return view('office.all-bookings', compact('bookings'));
        })->name('office.bookings');

        // Export routes
        Route::get('/office/export/trip-bookings/{trip}', [App\Http\Controllers\ExportController::class, 'tripBookings'])->name('office.export.trip-bookings');
        Route::get('/office/export/bookings', [App\Http\Controllers\ExportController::class, 'allOfficeBookings'])->name('office.export.bookings');

        // Financial overview (Office)
        Route::get('/office/financials', [FinancialController::class, 'officeIndex'])->name('office.financials');

        // Withdrawal requests (Office)
        Route::get('/office/withdrawals', [WithdrawalController::class, 'officeIndex'])->name('office.withdrawals');
        Route::post('/office/withdrawals', [WithdrawalController::class, 'store'])->name('office.withdrawals.store');
    });

    // Help page
    Route::get('/help', function () {
        return view('help');
    })->name('help');

    // Public trips view (with auth only) - MUST be LAST to not conflict with /trips/create
    Route::get('/trips/{trip}', [TripController::class, 'show'])->name('trips.show');
});

// Office registration request (public)
Route::get('/office/register-request', function () {
    return view('auth.office-register-request');
})->name('office.register.request');

Route::post('/office/register-request', function (\Illuminate\Http\Request $request) {
    $request->validate([
        'office_name' => ['required', 'string', 'max:255'],
        'contact_person' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
        'num1' => ['required', 'string', 'max:20'],
        'num2' => ['nullable', 'string', 'max:20'],
        'latitude' => ['nullable', 'string', 'max:50'],
        'longitude' => ['nullable', 'string', 'max:50'],
        'address' => ['nullable', 'string', 'max:1000'],
        'notes' => ['nullable', 'string', 'max:2000'],
    ]);

    \App\Models\OfficeRegistrationRequest::create($request->only([
        'office_name', 'contact_person', 'email', 'num1', 'num2',
        'latitude', 'longitude', 'address', 'notes',
    ]));

    return redirect()->back()->with('success', __('Your request has been submitted. We will review it and get back to you.'));
})->name('office.register.request.store');

require __DIR__.'/auth.php';
