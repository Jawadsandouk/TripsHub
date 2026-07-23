<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\OfficeRegistrationRequest;
use App\Models\Trip;
use App\Models\User;
use OpenSpout\Writer\XLSX\Writer;
use OpenSpout\Common\Entity\Row;
use OpenSpout\Common\Entity\Style\Style;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    private function getHeaderStyle(): Style
    {
        return (new Style())->setFontBold()->setFontSize(12);
    }

    private function writeRows(Writer $writer, array $headers, array $rows): void
    {
        $headerRow = Row::fromValues($headers, $this->getHeaderStyle());
        $writer->addRow($headerRow);
        foreach ($rows as $row) {
            $writer->addRow(Row::fromValues($row));
        }
    }

    public function trips()
    {
        $trips = Trip::with('user')->latest()->get();
        $writer = new Writer();
        $writer->openToBrowser("trips.xlsx");

        $headers = ['Place Name', 'Office', 'Price', 'Available Seats', 'Status', 'Departure Time'];
        $rows = $trips->map(fn($t) => [
            $t->getTranslatedName(),
            $t->user->name,
            $t->seat_price,
            $t->available_seats,
            $t->status,
            $t->departure_time,
        ])->toArray();

        $this->writeRows($writer, $headers, $rows);
        $writer->close();
    }

    public function bookings()
    {
        $bookings = Booking::with(['user', 'trip'])->latest()->get();
        $writer = new Writer();
        $writer->openToBrowser("bookings.xlsx");

        $headers = ['User', 'Trip', 'Office', 'Seats', 'Total Price', 'Date'];
        $rows = $bookings->map(fn($b) => [
            $b->user->name,
            $b->trip->getTranslatedName(),
            $b->trip->user->name,
            $b->number_of_seats,
            $b->total_price,
            $b->created_at,
        ])->toArray();

        $this->writeRows($writer, $headers, $rows);
        $writer->close();
    }

    public function officeRequests()
    {
        $requests = OfficeRegistrationRequest::latest()->get();
        $writer = new Writer();
        $writer->openToBrowser("office-requests.xlsx");

        $headers = ['Office Name', 'Contact Person', 'Email', 'Phone 1', 'Phone 2', 'Location', 'Address', 'Notes', 'Status', 'Date'];
        $rows = $requests->map(fn($r) => [
            $r->office_name,
            $r->contact_person,
            $r->email,
            $r->num1,
            $r->num2 ?? '',
            $r->latitude && $r->longitude ? $r->latitude . ', ' . $r->longitude : '',
            $r->address ?? '',
            $r->notes ?? '',
            $r->status,
            $r->created_at,
        ])->toArray();

        $this->writeRows($writer, $headers, $rows);
        $writer->close();
    }

    public function offices()
    {
        $offices = User::where('role', 'office')->with('trips')->latest()->get();
        $writer = new Writer();
        $writer->openToBrowser("offices.xlsx");

        $headers = ['Name', 'Email', 'Phone 1', 'Phone 2', 'Trips Count', 'Discount', 'Rating', 'Joined'];
        $rows = $offices->map(fn($o) => [
            $o->name,
            $o->email,
            $o->num1 ?? '',
            $o->num2 ?? '',
            $o->trips->count(),
            $o->discount ?? '',
            $o->averageRating() ?? '',
            $o->created_at,
        ])->toArray();

        $this->writeRows($writer, $headers, $rows);
        $writer->close();
    }

    public function users()
    {
        $users = User::latest()->get();
        $writer = new Writer();
        $writer->openToBrowser("users.xlsx");

        $headers = ['Name', 'Email', 'Role', 'Phone 1', 'Phone 2', 'Discount', 'Created'];
        $rows = $users->map(fn($u) => [
            $u->name,
            $u->email,
            $u->role,
            $u->num1 ?? '',
            $u->num2 ?? '',
            $u->role === 'office' ? ($u->discount ?? '') : '',
            $u->created_at,
        ])->toArray();

        $this->writeRows($writer, $headers, $rows);
        $writer->close();
    }

    public function tripBookings(Trip $trip)
    {
        $bookings = Booking::with('user')->where('trip_id', $trip->id)->orderBy('created_at', 'desc')->get();
        $writer = new Writer();
        $writer->openToBrowser("trip-{$trip->id}-bookings.xlsx");

        $headers = ['User', 'Seats', 'Total Price', 'Date'];
        $rows = $bookings->map(fn($b) => [
            $b->user->name,
            $b->number_of_seats,
            $b->total_price,
            $b->created_at,
        ])->toArray();

        $this->writeRows($writer, $headers, $rows);
        $writer->close();
    }

    public function allOfficeBookings()
    {
        $tripIds = auth()->user()->trips()->pluck('id');
        $bookings = Booking::with(['trip', 'user'])->whereIn('trip_id', $tripIds)->orderBy('created_at', 'desc')->get();
        $writer = new Writer();
        $writer->openToBrowser("all-bookings.xlsx");

        $headers = ['Trip', 'Customer', 'Seats', 'Total Price', 'Date'];
        $rows = $bookings->map(fn($b) => [
            $b->trip->getTranslatedName(),
            $b->user->name,
            $b->number_of_seats,
            $b->total_price,
            $b->created_at,
        ])->toArray();

        $this->writeRows($writer, $headers, $rows);
        $writer->close();
    }
}
