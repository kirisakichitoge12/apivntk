<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Mail\BookingInvoiceMail;
use App\Models\Banner;
use App\Models\Booking;
use Illuminate\Container\Attributes\Storage;
use Illuminate\Http\Request;
use Carbon\Carbon; 
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{
    

    public function store(Request $request)
    {
        // (Tùy chọn) validate nhẹ
        // $request->validate([
        //   'GuestContact.Email' => 'nullable|email',
        //   'ListPassenger'      => 'array',
        //   'Flights'            => 'array',
        // ]);

        DB::beginTransaction();
        try {
            $data = $request->all();
            Log::info('📦 Dữ liệu nhận được từ bookFlight:', $data);
            // dd($data);

            // ===== 0) TÍNH SỐ LƯỢNG KHÁCH =====
            $paxList   = $data['ListPassenger'] ?? [];
            $paxAdult  = collect($paxList)->where('Type', 'ADT')->count();
            $paxChild  = collect($paxList)->where('Type', 'CHD')->count();
            $paxInfant = collect($paxList)->where('Type', 'INF')->count();
            $paxTotal  = count($paxList);

            // ===== 1) BOOKING =====
            $booking = Booking::create([
                'guest_area'   => $data['GuestContact']['Area']   ?? '',
                'guest_phone'  => $data['GuestContact']['Phone']  ?? '',
                'guest_email'  => $data['GuestContact']['Email']  ?? '',
                'guest_name'   => $data['GuestContact']['Name']   ?? '',
                'guest_address'=> $data['GuestContact']['Address']?? '',
                'guest_remark' => $data['GuestContact']['Remark'] ?? '',

                'agent_email'  => $data['AgentContact']['Email']  ?? '',
                'agent_phone'  => $data['AgentContact']['Phone']  ?? '',

                'total_price'  => $data['totalPrice']['amount']   ?? 0,
                'currency'     => $data['totalPrice']['currency'] ?? 'VND',

                // các cột số lượng khách (nếu có trong DB)
                'pax_adult'    => $paxAdult,
                'pax_child'    => $paxChild,
                'pax_infant'   => $paxInfant,
                'pax_total'    => $paxTotal,
            ]);

            // ===== 2) INVOICE (nếu có) =====
            if (!empty($data['Invoice'])) {
                $booking->Invoice()->create([
                    'company_name'   => $data['Invoice']['CompanyName']   ?? '',
                    'company_tax_code'=> $data['Invoice']['CompanyTaxCode']?? '',
                    'company_address'=> $data['Invoice']['CompanyAddress']?? '',
                    'receiver_name'  => $data['Invoice']['ReceiverName']  ?? '',
                    'receiver_address'=> $data['Invoice']['ReceiverAddress']?? '',
                    'receiver_phone' => $data['Invoice']['ReceiverPhone'] ?? '',
                    'receiver_email' => $data['Invoice']['ReceiverEmail'] ?? '',
                    'remark'         => $data['Invoice']['Remark']        ?? '',
                ]);
            }

            // ===== 3) LIST AIR OPTION (chung booking) =====
            foreach ($data['ListAirOption'] ?? [] as $option) {
                $booking->ListAirOption()->create([
                    'session'      => $option['Session']     ?? null,
                    'session_type' => $option['SessionType'] ?? null,
                ]);
            }

            // ===== 4) FLIGHTS (chung booking, CHỈ 1 LẦN) =====
            // foreach ($data['Flights'] ?? [] as $flight) {
            //     $booking->flights()->create([
            //         'airline'       => $flight['Airline']       ?? '',
            //         'flight_number' => $flight['FlightNumber']  ?? '',
            //         'start_point'   => $flight['StartPoint']    ?? '',
            //         'end_point'     => $flight['EndPoint']      ?? '',
            //         'start_date'    => isset($flight['StartDate']) ? Carbon::parse($flight['StartDate']) : null,
            //         'end_date'      => isset($flight['EndDate'])   ? Carbon::parse($flight['EndDate'])   : null,
            //         'fare_class'    => $flight['FareClass']     ?? '',
            //     ]);
            // }
        foreach ($data['Flights'] ?? [] as $flight) {
            $booking->flights()->create([
                    'airline'       => $flight['Airline']        ?? '',
                    'airline_name'  => $flight['AirlineName']    ?? '', // tên hãng
                    'flight_number' => $flight['FlightNumber']   ?? '',
                    'start_point'   => $flight['StartPoint']     ?? '',
                    'start_city'    => $flight['StartCityName']  ?? '', // thành phố đi
                    'end_point'     => $flight['EndPoint']       ?? '',
                    'end_city'      => $flight['EndCityName']    ?? '', // thành phố đến
                    'start_date'    => isset($flight['StartDate']) ? Carbon::parse($flight['StartDate']) : null,
                    'end_date'      => isset($flight['EndDate'])   ? Carbon::parse($flight['EndDate'])   : null,
                    'fare_class'    => $flight['FareClass']      ?? '',
                ]);
        }
            // ===== 5) SERVICE FEE (chung booking, CHỈ 1 LẦN) =====
            foreach ($data['ServiceFee'] ?? [] as $fee) {
                $booking->service_fees()->create([
                    'name'     => $fee['Name']     ?? '',
                    'amount'   => $fee['Amount']   ?? 0,
                    'currency' => $fee['Currency'] ?? 'VND',
                ]);
            }

            // ===== 6) SERVICES NGOÀI PASSENGER (chung booking, CHỈ 1 LẦN) =====
            foreach ($data['Services'] ?? [] as $service) {
                $booking->services()->create([
                    'system'   => $service['System']   ?? '',
                    'airline'  => $service['Airline']  ?? '',
                    'type'     => $service['Type']     ?? '',
                    'name'     => $service['Name']     ?? '',
                    'price'    => $service['Price']    ?? 0,
                    'currency' => $service['Currency'] ?? 'VND',
                ]);
            }

            // ===== 7) PASSENGERS (mỗi khách 1 bản ghi) =====
            foreach ($paxList as $pax) {
                $passenger = $booking->ListPassenger()->create([
                    'index'           => $pax['Index']         ?? null,
                    'type'            => $pax['Type']          ?? null,
                    'gender'          => $pax['Gender']        ?? null,

                    'document_type'   => $pax['DocumentType']  ?? null,
                    'nationality'     => $pax['Nationality']   ?? null,
                    'issue_country'   => $pax['IssueCountry']  ?? null,

                    'seat_class'      => $pax['seat_class']    ?? null,
                    'title'           => $pax['Title']         ?? '',
                    'full_name'       => $pax['FullName']      ?? '',
                    'given_name'      => $pax['GivenName']     ?? '',
                    'surname'         => $pax['Surname']       ?? '',
                    'date_of_birth'   => isset($pax['DateOfBirth'])
                                            ? Carbon::createFromFormat('dmY', $pax['DateOfBirth'])->format('Y-m-d')
                                            : null,

                    'passport_documentType'  => $pax['Passport']['DocumentType']   ?? '',
                    'passport_nationality'   => $pax['Passport']['Nationality']    ?? '',
                    'passport_issue_country' => $pax['Passport']['IssueCountry']   ?? '',
                    'passport_document_code' => $pax['Passport']['DocumentCode']   ?? '',
                    'passport_document_expiry'=> isset($pax['Passport']['DocumentExpiry'])
                                                    ? Carbon::createFromFormat('d/m/Y', $pax['Passport']['DocumentExpiry'])->format('Y-m-d')
                                                    : null,
                ]);

                // 7.1 Baggage theo passenger
                foreach ($pax['ListBaggage'] ?? [] as $baggage) {
                    $passenger->list_baggage()->create([
                        'system'      => $baggage['System']     ?? null,
                        'airline'     => $baggage['Airline']    ?? null,
                        'value'       => $baggage['Value']      ?? null,
                        'type'        => $baggage['Type']       ?? null,
                        'pax_type'    => $baggage['PaxType']    ?? null,
                        'name'        => $baggage['Name']       ?? null,
                        'description' => $baggage['Description']?? null,
                        'price'       => $baggage['Price']      ?? null,
                        'currency'    => $baggage['Currency']   ?? null,
                        'leg'         => $baggage['Leg']        ?? null,
                        'start_point' => $baggage['StartPoint'] ?? null,
                        'end_point'   => $baggage['EndPoint']   ?? null,
                        'confirmed'   => $baggage['Confirmed']  ?? false,
                        'session'     => $baggage['Session']    ?? null,
                    ]);
                }

                // 7.2 Service theo passenger
                foreach ($pax['ListService'] ?? [] as $svc) {
                    $passenger->list_service()->create([
                        'system'      => $svc['System']     ?? null,
                        'airline'     => $svc['Airline']    ?? null,
                        'value'       => $svc['Value']      ?? null,
                        'type'        => $svc['Type']       ?? null,
                        'pax_type'    => $svc['PaxType']    ?? null,
                        'name'        => $svc['Name']       ?? null,
                        'description' => $svc['Description']?? null,
                        'price'       => $svc['Price']      ?? null,
                        'currency'    => $svc['Currency']   ?? null,
                        'leg'         => $svc['Leg']        ?? null,
                        'start_point' => $svc['StartPoint'] ?? null,
                        'end_point'   => $svc['EndPoint']   ?? null,
                        'confirmed'   => $svc['Confirmed']  ?? false,
                        'session'     => $svc['Session']    ?? null,
                    ]);
                }

                // 7.3 PreSeat theo passenger
                foreach ($pax['ListPreSeat'] ?? [] as $seat) {
                    $passenger->list_preSeat()->create([
                        'airline'     => $seat['Airline']    ?? null,
                        'code'        => $seat['Code']       ?? null,
                        'confirmed'   => $seat['Confirmed']  ?? false,
                        'currency'    => $seat['Currency']   ?? null,
                        'start_point' => $seat['StartPoint'] ?? null,
                        'end_point'   => $seat['EndPoint']   ?? null,
                        'leg'         => $seat['Leg']        ?? null,
                        'name'        => $seat['Name']       ?? null,
                        'price'       => $seat['Price']      ?? null,
                        'session'     => $seat['Session']    ?? null,
                        'value'       => $seat['Value']      ?? null,
                    ]);
                }

                // 7.4 Membership theo passenger
                foreach ($pax['ListMembership'] ?? [] as $member) {
                    $passenger->list_membership()->create([
                        'airline'       => $member['Airline']      ?? '',
                        'membership_id' => $member['MembershipID'] ?? '',
                    ]);
                }
            }

           if (!empty($data['TotalFare'])) {
            $booking->detail()->create([
                'list_fare'     => $data['ListFare']     ?? null,
                'list_baggage'  => $data['ListBaggage']  ?? null,
                'list_service'  => $data['ListService']  ?? null,
                'list_pre_seat' => $data['ListPreSeat']  ?? null,
                'baggage_price' => $data['BaggagePrice'] ?? null,
                'service_price' => $data['ServicePrice'] ?? null,
                'seat_price'    => $data['SeatPrice']    ?? null,
                'total_fare'    => $data['TotalFare']    ?? null,
            ]);
        }
          Log::info('DetailData: ' . $data['TotalFare']);
        //    dd($booking);
            DB::commit();
              Mail::to($booking->guest_email)->send(new BookingInvoiceMail($booking));

                return response()->json([
                    'message' => 'Booking created and email sent successfully'
                ]);
            return response()->json([
                'success'    => true,
                'booking_id' => $booking->id
            ], 201);

        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('❌ Lưu booking thất bại: '.$e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return response()->json([
                'message' => 'Lưu dữ liệu thất bại',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

//    public function store(Request $request)
//     {
//         DB::beginTransaction();
//         try {
//             $data = $request->all();
//              Log::info('📦 Dữ liệu nhận được từ bookFlight:', $data);
//             //  dd($data);
//             // 1. Booking
//             $booking = Booking::create([
//                 'guest_area' => $data['GuestContact']['Area'] ?? '',
//                 'guest_phone' => $data['GuestContact']['Phone'] ?? '',
//                 'guest_email' => $data['GuestContact']['Email'] ?? '',
//                 'guest_name' => $data['GuestContact']['Name'] ?? '',
//                 'guest_address' => $data['GuestContact']['Address'] ?? '',
//                 'guest_remark' => $data['GuestContact']['Remark'] ?? '',
//                 // 'guest_code' => $data['ListPassenger']['DocumentCode'] ?? '',
//                 // 'guest_expiry' => $data['ListPassenger']['DocumentExpiry'] ?? '',
//                 'agent_email' => $data['AgentContact']['Email'] ?? '',
//                 'agent_phone' => $data['AgentContact']['Phone'] ?? '',
//                 'total_price' => $data['totalPrice']['amount'] ?? 0,
//                 'currency' => $data['totalPrice']['currency'] ?? 'VND',
//                 'created_at' => now(),
//                 'updated_at' => now(),
//             ]);
//             // 2. Invoice
//             if (!empty($data['Invoice'])) {
//                 $booking->Invoice()->create([
//                     'company_name' => $data['Invoice']['CompanyName'] ?? '',
//                     'company_tax_code' => $data['Invoice']['CompanyTaxCode'] ?? '',
//                     'company_address' => $data['Invoice']['CompanyAddress'] ?? '',
//                     'receiver_name' => $data['Invoice']['ReceiverName'] ?? '',
//                     'receiver_address' => $data['Invoice']['ReceiverAddress'] ?? '',
//                     'receiver_phone' => $data['Invoice']['ReceiverPhone'] ?? '',
//                     'receiver_email' => $data['Invoice']['ReceiverEmail'] ?? '',
//                     'remark' => $data['Invoice']['Remark'] ?? '',
//                 ]);
//             }
//             // 3. ListAirOption
//             foreach ($data['ListAirOption'] ?? [] as $option) {
//                 $booking->ListAirOption()->create([
//                     'session' => $option['Session'],
//                     'session_type' => $option['SessionType'],
//                 ]);
//             }
//             // 4. ListPassenger
//             foreach ($data['ListPassenger'] ?? [] as $pax) {
//                 $passenger = $booking->ListPassenger()->create([
//                     'index' => $pax['Index'],
//                     'type' => $pax['Type'],
//                     'gender' => $pax['Gender'] ?? null,
//                     'document_type' => $pax['DocumentType'],
//                     'nationality' => $pax['Nationality'],
//                     'issue_country' => $pax['IssueCountry'],
//                     'seat_class' => $pax['seat_class'] ?? null,
//                     'title' => $pax['Title'] ?? '',
//                     'full_name' => $pax['FullName'],
//                     'given_name' => $pax['GivenName'],
//                     'surname' => $pax['Surname'],
//                     'date_of_birth' => isset($pax['DateOfBirth']) ? Carbon::createFromFormat('dmY', $pax['DateOfBirth'])->format('Y-m-d') : null,
//                     'passport_documentType' => $pax['Passport']['DocumentType'] ?? '',
//                     'passport_nationality' => $pax['Passport']['Nationality'] ?? '',
//                     'passport_issue_country' => $pax['Passport']['IssueCountry'] ?? '',
//                     'passport_document_code' => $pax['Passport']['DocumentCode'] ?? '',
//                     'passport_document_expiry' => isset($pax['Passport']['DocumentExpiry']) 
//                         ? Carbon::createFromFormat('d/m/Y', $pax['Passport']['DocumentExpiry'])->format('Y-m-d') 
//                         : null,

//                 ]);

//                 // 4.1 ListBaggage
//                 foreach ($pax['ListBaggage'] ?? [] as $baggage) {
//                      $passenger->list_baggage()->create([
//                     'system' => $baggage['System'] ?? null,
//                     'airline' => $baggage['Airline'] ?? null,
//                     'value' => $baggage['Value'] ?? null,
//                     'type' => $baggage['Type'] ?? null,
//                     'pax_type' => $baggage['PaxType'] ?? null,
//                     'name' => $baggage['Name'] ?? null,
//                     'description' => $baggage['Description'] ?? null,
//                     'price' => $baggage['Price'] ?? null,
//                     'currency' => $baggage['Currency'] ?? null,
//                     'leg' => $baggage['Leg'] ?? null,
//                     'start_point' => $baggage['StartPoint'] ?? null,
//                     'end_point' => $baggage['EndPoint'] ?? null,
//                     'confirmed' => $baggage['Confirmed'] ?? false,
//                     'session' => $baggage['Session'] ?? null,
//                     ]);
//                 }
//                     // 4.2. Flights
//                     foreach ($data['Flights'] ?? [] as $flight) {
//                         $booking->flights()->create([
//                             'airline' => $flight['Airline'] ?? '',
//                             'flight_number' => $flight['FlightNumber'] ?? '',
//                             'start_point' => $flight['StartPoint'] ?? '',
//                             'end_point' => $flight['EndPoint'] ?? '',
//                             'start_date' => $flight['StartDate'] ?? null,
//                             'end_date' => $flight['EndDate'] ?? null,
//                             'fare_class' => $flight['FareClass'] ?? '',
//                         ]);
//                     }

//                 // 4.4 ListService
//                 foreach ($pax['ListService'] ?? [] as $service) {
//                     $passenger->list_service()->create([
//                     'system' => $service['System'] ?? null,
//                     'airline' => $service['Airline'] ?? null,
//                     'value' => $service['Value'] ?? null,
//                     'type' => $service['Type'] ?? null,
//                     'pax_type' => $service['PaxType'] ?? null,
//                     'name' => $service['Name'] ?? null,
//                     'description' => $service['Description'] ?? null,
//                     'price' => $service['Price'] ?? null,
//                     'currency' => $service['Currency'] ?? null,
//                     'leg' => $service['Leg'] ?? null,
//                     'start_point' => $service['StartPoint'] ?? null,
//                     'end_point' => $service['EndPoint'] ?? null,
//                     'confirmed' => $service['Confirmed'] ?? false,
//                     'session' => $service['Session'] ?? null,
//                 ]);
//                 }

//                 // 4.3 ListPreSeat
//                 foreach ($pax['ListPreSeat'] ?? [] as $seat) {
//                     $passenger->list_preSeat()->create([
//                     'airline' => $seat['Airline'] ?? null,
//                     'code' => $seat['Code'] ?? null,
//                     'confirmed' => $seat['Confirmed'] ?? false,
//                     'currency' => $seat['Currency'] ?? null,
//                     'start_point' => $seat['StartPoint'] ?? null,
//                     'end_point' => $seat['EndPoint'] ?? null,
//                     'leg' => $seat['Leg'] ?? null,
//                     'name' => $seat['Name'] ?? null,
//                     'price' => $seat['Price'] ?? null,
//                     'session' => $seat['Session'] ?? null,
//                     'value' => $seat['Value'] ?? null,
//                 ]);
//                 }
//                 // 4.4 ListMembership
//                 foreach ($pax['ListMembership'] ?? [] as $member) {
//                     $passenger->list_membership()->create([
//                         'airline' => $member['Airline'] ?? '',
//                         'membership_id' => $member['MembershipID'] ?? '',
//                     ]);
//                 }
//                 // 6. ServiceFee
//                 foreach ($data['ServiceFee'] ?? [] as $fee) {
//                     $booking->service_fees()->create([
//                         'name' => $fee['Name'] ?? '',
//                         'amount' => $fee['Amount'] ?? 0,
//                         'currency' => $fee['Currency'] ?? 'VND',
//                     ]);
//                 }
               
//                 // 7. Services ngoài passenger
//             foreach ($data['Services'] ?? [] as $service) {
//                 $booking->services()->create([
//                     'system' => $service['System'] ?? '',
//                     'airline' => $service['Airline'] ?? '',
//                     'type' => $service['Type'] ?? '',
//                     'name' => $service['Name'] ?? '',
//                     'price' => $service['Price'] ?? 0,
//                     'currency' => $service['Currency'] ?? 'VND',
//                 ]);
//             }


//             }

//             DB::commit();
//             return response()->json(['success' => true, 'booking_id' => $booking->id], 201);
//         } catch (\Exception $e) {
//             DB::rollBack();
//             return response()->json(['vào được nhưng không lưu được' => $e->getMessage()], 500);
//         }
//     }

    // public function index()
    // {
    //     $banners = Banner::latest()->get();
    //     return view('admin.banner_manage', compact('banners'));
    // }

    // Trang danh sách đơn hàng
    public function index()
    {
        $bookings = Booking::with([
            'airOptions', 
            'passengers.baggages', 
            'passengers.services', 
            'passengers.preSeats', 
            'invoice'
        ])
        ->orderBy('created_at', 'desc')
        ->paginate(10); // mỗi trang 10 bản ghi

        return view('admin.manager_orders', compact('bookings'));
    }



    // Trang chi tiết (nếu bạn muốn mở riêng thay vì modal)
    public function show($id)
    {
        $booking = Booking::findOrFail($id);

        return view('admin.show', compact('booking'));
    }



}
