<?php

namespace App\Services;

use App\Models\RoomBook;

class RoomBookingService
{
    public function checkBookingDate($checkIn, $checkOut, $roomId)
    {
        $existingBookings = RoomBook::where('room_id', $roomId)
            ->where(function ($query) use ($checkIn, $checkOut) {
                $query->whereBetween('check_in', [$checkIn, $checkOut])
                    ->orWhereBetween('check_out', [$checkIn, $checkOut])
                    ->orWhere(function ($query) use ($checkIn, $checkOut) {
                        $query->where('check_in', '<', $checkIn)
                            ->where('check_out', '>', $checkOut);
                    });
            })
            ->get();

        return $existingBookings->isEmpty() ? 1 : 0;
    }
}
