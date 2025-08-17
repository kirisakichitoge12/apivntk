<?php

namespace App\Mail;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class BookingInvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;
    public $passengerCount;

    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
        // Đếm số lượng hành khách từ bảng bookings_flights
        $this->passengerCount = $booking->flights()->count();
    }

    public function build()
    {
        Log::info('Booking detail:', [$this->booking->detail]);
        return $this->subject('Hóa đơn đặt vé máy bay - Vietnam Tickets')
                    ->view('emails.email-invoid')
                    ->with([
                        'booking' => $this->booking,
                        'passengerCount' => $this->passengerCount,
                        'services' => $this->booking->services, 
                        'details' => $this->booking->detail, 
                    ]);
    }
}
