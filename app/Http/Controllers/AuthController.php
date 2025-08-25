<?php

namespace App\Http\Controllers;

use App\Interfaces\AuthInterface;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;


class AuthController extends Controller
{
    protected $auth;

    public function __construct(AuthInterface $auth)
    {
        $this->auth = $auth;
    }

    public function register(Request $request)
    {
        $data = $request->only(['name', 'email', 'phone', 'password']);
        $user = $this->auth->register($data);
        return $user;
    }

    public function verifyEmail(Request $request)
    {
        $token = $request->query('token');
        $user = $this->auth->findByEmailVerificationToken($token);

        if (!$user) {
            return response()->json(['message' => 'Token không hợp lệ'], 400);
        }

        $user->update(['email_verified_at' => now(), 'email_verification_token' => null]);

        return redirect('
        /dang-nhap');
    }

    // public function login(Request $request)
    // {
    //     try {
    //         $validated = $request->validate([
    //             'email' => 'required|email',
    //             'password' => 'required|min:6',
    //         ]);

    //         $user = $this->auth->login($validated);

    //         if ($user) {
    //             return $user;
    //         }

    //         return response()->json([
    //             'message' => 'Error',
    //             'error' => 'Mật khẩu hoặc địa chỉ email không chính xác!',
    //         ], 401);

    //     } catch (ValidationException $e) {
    //         return response()->json([
    //             'success' => false,
    //             'error' => $e->errors(),
    //         ], 422);
    //     }
    // }
    // public function login(Request $request)
    // {
    //     try {
    //         $validated = $request->validate([
    //             'email' => 'required|email',
    //             'password' => 'required|min:6',
    //         ]);

    //         $result = $this->auth->login($validated);

    //         if ($result && isset($result['success']) && $result['success'] === true) {
    //             return response()->json($result, 200);
    //         }

    //         return response()->json([
    //             'message' => 'Error',
    //             'error' => $result['message'] ?? 'Mật khẩu hoặc địa chỉ email không chính xác!',
    //         ], 401);

    //     } catch (ValidationException $e) {
    //         return response()->json([
    //             'success' => false,
    //             'error' => $e->errors(),
    //         ], 422);
    //     }
    // }
    
    // public function login(Request $request)
    // {
    //     try {
    //         $validated = $request->validate([
    //             'email' => 'required|email',
    //             'password' => 'required|min:6',
    //         ]);

    //         $result = $this->auth->login($validated);

    //         if ($result && isset($result['success']) && $result['success'] === true) {
    //             // Lấy email user đã đăng nhập
    //             $userEmail = $validated['email'];

    //             // Lấy booking kèm quan hệ
    //             $bookings = Booking::with([
    //                 'airOptions',
    //                 'passengers.baggages',
    //                 'passengers.services',
    //                 'passengers.preSeats',
    //                 'invoice',
    //                 'flights',
    //                 'service_fees',
    //                 'services'
    //             ])
    //             ->where('guest_email', $userEmail) 
    //             ->orderBy('created_at', 'desc')
    //             ->get();

    //             // Trả kết quả login + bookings
    //             return response()->json([
    //                 'success' => true,
    //                 'user' => $result['user'] ?? null, // hoặc dữ liệu user từ auth
    //                 'token' => $result['token'] ?? null,
    //                 'bookings' => $bookings
    //             ], 200);
    //         }

    //         return response()->json([
    //             'message' => 'Error',
    //             'error' => $result['message'] ?? 'Mật khẩu hoặc địa chỉ email không chính xác!',
    //         ], 401);

    //     } catch (ValidationException $e) {
    //         return response()->json([
    //             'success' => false,
    //             'error' => $e->errors(),
    //         ], 422);
    //     }
    // }
     public function login(Request $request)
    {
        try {
            $validated = $request->validate([
                'email' => 'required|email',
                'password' => 'required|min:6',
            ]);

            if (!$token = auth()->attempt($validated)) {
                return response()->json(['error' => 'Email hoặc mật khẩu không đúng'], 401);
            }

            $user = auth()->user();

            // Nếu là admin
            if ($user->role === 'admin') {
                return response()->json([
                    'success' => true,
                    'role' => 'admin',
                    'demo' => 'admin nè',
                    'user' => $user,
                    'token' => $token,
                ], 200);
            }

            // Nếu là user thì load bookings
            $bookings = Booking::with([
                'flights',
                'detail',
            ])
            ->where('guest_email', $validated['email'])
            ->orderBy('created_at', 'desc')
            ->get();

            Log::info('Đăng nhập thành công', [
                'user_id' => $user->id,
                'email' => $user->email,
                'bookings_count' => $bookings->count(),
                'bookings' => $bookings->toArray(), // Ghi toàn bộ dữ liệu bookings
            ]);
            return response()->json([
                'success' => true,
                'role' => 'user',
                'user' => $user,
                'token' => $token,
                'bookings' => $bookings,
            ], 200);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'error' => $e->errors(),
            ], 422);
        }
    }



    public function logout()
    {
        $this->auth->logout();
        return response()->json(['message' => 'Đăng xuất thành công']);
    }
}
