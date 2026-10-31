<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    // READ: admin sees every booking, a customer sees only their own
    public function index()
    {
        $query = Booking::with(['user', 'activity'])->latest();

        if (auth()->user()->role !== 'admin') {
            $query->where('user_id', auth()->id());
        }

        $bookings = $query->get();
        return view('bookings.index', compact('bookings'));
    }

    // CREATE: show the form (an activity can be pre-selected with ?activity=A001)
    public function create(Request $request)
    {
        $activities = Activity::orderBy('name')->get();
        $selected = $request->query('activity');
        return view('bookings.create', compact('activities', 'selected'));
    }

    // CREATE: save to the database
    public function store(Request $request)
    {
        $data = $request->validate([
            'activity_code' => 'required|exists:activities,code',
            'participants'  => 'required|integer|min:1|max:20',
            'safety_notes'  => 'nullable|string|max:500',
        ]);

        // These two are set by the code, not by the form
        $data['user_id'] = auth()->id();
        $data['status']  = 'pending';

        Booking::create($data);

        return redirect()->route('bookings.index')
                         ->with('success', 'Booking submitted. Waiting for confirmation.');
    }

    // UPDATE: show the form
    public function edit(Booking $booking)
    {
        $this->checkOwner($booking);
        return view('bookings.edit', compact('booking'));
    }

    // UPDATE: save changes
    public function update(Request $request, Booking $booking)
    {
        $this->checkOwner($booking);

        $rules = [
            'participants' => 'required|integer|min:1|max:20',
            'safety_notes' => 'nullable|string|max:500',
        ];

        // Only the admin may change the status
        if (auth()->user()->role === 'admin') {
            $rules['status'] = 'required|in:pending,confirmed,cancelled';
        }

        $booking->update($request->validate($rules));

        return redirect()->route('bookings.index')
                         ->with('success', 'Booking updated.');
    }

    // DELETE
    public function destroy(Booking $booking)
    {
        $this->checkOwner($booking);
        $booking->delete();

        return redirect()->route('bookings.index')
                         ->with('success', 'Booking deleted.');
    }

    // A customer may only touch their own booking. The admin may touch any.
    private function checkOwner(Booking $booking)
    {
        if (auth()->user()->role !== 'admin' && $booking->user_id !== auth()->id()) {
            abort(403, 'This is not your booking.');
        }
    }
}
