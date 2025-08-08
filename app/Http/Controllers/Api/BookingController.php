<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Booking;
use Illuminate\Container\Attributes\Storage;
use Illuminate\Http\Request;
use Carbon\Carbon; 

class BookingController extends Controller
{
    
   public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->all();
            // 1. Booking
            $booking = Booking::create([
                'guest_area' => $data['GuestContact']['Area'] ?? '',
                'guest_phone' => $data['GuestContact']['Phone'] ?? '',
                'guest_email' => $data['GuestContact']['Email'] ?? '',
                'guest_name' => $data['GuestContact']['Name'] ?? '',
                'guest_address' => $data['GuestContact']['Address'] ?? '',
                'guest_remark' => $data['GuestContact']['Remark'] ?? '',
                'agent_email' => $data['AgentContact']['Email'] ?? '',
                'agent_phone' => $data['AgentContact']['Phone'] ?? '',
                'total_price' => $data['totalPrice']['amount'] ?? 0,
                'currency' => $data['totalPrice']['currency'] ?? 'VND',
            ]);
            // 2. Invoice
            if (!empty($data['Invoice'])) {
                $booking->Invoice()->create([
                    'company_name' => $data['Invoice']['CompanyName'] ?? '',
                    'company_tax_code' => $data['Invoice']['CompanyTaxCode'] ?? '',
                    'company_address' => $data['Invoice']['CompanyAddress'] ?? '',
                    'receiver_name' => $data['Invoice']['ReceiverName'] ?? '',
                    'receiver_address' => $data['Invoice']['ReceiverAddress'] ?? '',
                    'receiver_phone' => $data['Invoice']['ReceiverPhone'] ?? '',
                    'receiver_email' => $data['Invoice']['ReceiverEmail'] ?? '',
                    'remark' => $data['Invoice']['Remark'] ?? '',
                ]);
            }
            // 3. ListAirOption
            foreach ($data['ListAirOption'] ?? [] as $option) {
                $booking->ListAirOption()->create([
                    'session' => $option['Session'],
                    'session_type' => $option['SessionType'],
                ]);
            }
            // 4. ListPassenger
            foreach ($data['ListPassenger'] ?? [] as $pax) {
                $passenger = $booking->ListPassenger()->create([
                    'index' => $pax['Index'],
                    'type' => $pax['Type'],
                    'gender' => $pax['Gender'] ?? null,
                    'document_type' => $pax['DocumentType'],
                    'nationality' => $pax['Nationality'],
                    'issue_country' => $pax['IssueCountry'],
                    'seat_class' => $pax['seat_class'] ?? null,
                    'title' => $pax['Title'] ?? '',
                    'full_name' => $pax['FullName'],
                    'given_name' => $pax['GivenName'],
                    'surname' => $pax['Surname'],
                    'date_of_birth' => isset($pax['DateOfBirth']) ? Carbon::createFromFormat('dmY', $pax['DateOfBirth'])->format('Y-m-d') : null,
                    'passport_documentType' => $pax['Passport']['DocumentType'] ?? '',
                    'passport_nationality' => $pax['Passport']['Nationality'] ?? '',
                    'passport_issue_country' => $pax['Passport']['IssueCountry'] ?? '',
                ]);

                // 4.1 ListBaggage
                foreach ($pax['ListBaggage'] ?? [] as $baggage) {
                     $passenger->list_baggage()->create([
                    'system' => $baggage['System'] ?? null,
                    'airline' => $baggage['Airline'] ?? null,
                    'value' => $baggage['Value'] ?? null,
                    'type' => $baggage['Type'] ?? null,
                    'pax_type' => $baggage['PaxType'] ?? null,
                    'name' => $baggage['Name'] ?? null,
                    'description' => $baggage['Description'] ?? null,
                    'price' => $baggage['Price'] ?? null,
                    'currency' => $baggage['Currency'] ?? null,
                    'leg' => $baggage['Leg'] ?? null,
                    'start_point' => $baggage['StartPoint'] ?? null,
                    'end_point' => $baggage['EndPoint'] ?? null,
                    'confirmed' => $baggage['Confirmed'] ?? false,
                    'session' => $baggage['Session'] ?? null,
                    ]);
                }

                // 4.2 ListService
                foreach ($pax['ListService'] ?? [] as $service) {
                    $passenger->list_service()->create([
                    'system' => $service['System'] ?? null,
                    'airline' => $service['Airline'] ?? null,
                    'value' => $service['Value'] ?? null,
                    'type' => $service['Type'] ?? null,
                    'pax_type' => $service['PaxType'] ?? null,
                    'name' => $service['Name'] ?? null,
                    'description' => $service['Description'] ?? null,
                    'price' => $service['Price'] ?? null,
                    'currency' => $service['Currency'] ?? null,
                    'leg' => $service['Leg'] ?? null,
                    'start_point' => $service['StartPoint'] ?? null,
                    'end_point' => $service['EndPoint'] ?? null,
                    'confirmed' => $service['Confirmed'] ?? false,
                    'session' => $service['Session'] ?? null,
                ]);
                }

                // 4.3 ListPreSeat
                foreach ($pax['ListPreSeat'] ?? [] as $seat) {
                    $passenger->list_preSeat()->create([
                    'airline' => $seat['Airline'] ?? null,
                    'code' => $seat['Code'] ?? null,
                    'confirmed' => $seat['Confirmed'] ?? false,
                    'currency' => $seat['Currency'] ?? null,
                    'start_point' => $seat['StartPoint'] ?? null,
                    'end_point' => $seat['EndPoint'] ?? null,
                    'leg' => $seat['Leg'] ?? null,
                    'name' => $seat['Name'] ?? null,
                    'price' => $seat['Price'] ?? null,
                    'session' => $seat['Session'] ?? null,
                    'value' => $seat['Value'] ?? null,
                ]);
                }
            }

            DB::commit();
            return response()->json(['success' => true, 'booking_id' => $booking->id], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['vào được nhưng không lưu được' => $e->getMessage()], 500);
        }
    }

    public function index()
    {
        $banners = Banner::latest()->get();
        return view('admin.banner_manage', compact('banners'));
    }
}
