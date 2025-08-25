<?php

namespace App\Repositories;

use App\Interfaces\AuthInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthRepository implements AuthInterface
{
    public function login(array $credentials)
    {
        if (!$token = JWTAuth::attempt($credentials)) {
          return [
            'success' => false,
            'message' => 'Email hoặc mật khẩu không đúng'
         ];
        }

        $user = JWTAuth::user();

        if ($user->email_verification_token !== null) {
            return [
                'success' => false,
                'message' => 'Bạn chưa xác thực email!',
            ];
        }

        return [
            'success' => true,
            'message' => 'Đăng nhập thành công',
            'user'    => $user,
            'token'   => $token,
            'token_type' => 'bearer',
            'expires_in' => config('jwt.ttl') * 60,
        ];
    }

    // public function login(array $credentials)
    // {
    //     if (Auth::attempt($credentials)) {
    //         if (Auth::user()->email_verification_token === null) {
    //             return response()->json([
    //                 'success' => true,
    //                 'message' => 'Đăng nhập thành công',
    //                 'user'    => Auth::user(),
    //             ], 200);
    //         }

    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Bạn chưa xác thực email!',
    //         ], 401);
    //     }
    //     return false;
    // }

    public function logout()
    {
        Auth::logout();
    }

    public function register(array $data)
    {
        if (User::where('email', $data['email'])->exists()) {
            return response()->json(['error' => 'Tài khoản đã tồn tại'], 400);
        }
        if (User::where('phone', $data['phone'])->exists()) {
            return response()->json(['error' => 'Số điện thoại đã được sử dụng'], 400);
        }

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
            'email_verification_token' => Str::random(60),
        ]);

        $this->sendAccountVerificationEmail($user->email, $user->email_verification_token);

        return response()->json([
            'message' => 'Đăng ký thành công! Vui lòng kiểm tra email để xác nhận tài khoản.',
        ]);
    }

    public function sendAccountVerificationEmail(string $email, string $token): void
    {
        $verificationUrl = url('/verify-email?token=' . $token);

        Mail::send('emails.verify-account', ['url' => $verificationUrl], function ($message) use ($email) {
            $message->to($email)->subject('Xác nhận tài khoản');
        });
    }

    public function findByEmailVerificationToken($token)
    {
        return User::where('email_verification_token', $token)->first();
    }

    public function sendPasswordResetEmail(string $email, string $token): void
    {
        $resetUrl = url('https://nhahang.hungthinhsecurity.com/authentication/reset-password-form?token=' . $token . '&email=' . $email);

        Mail::send('emails.reset-password', ['url' => $resetUrl], function ($message) use ($email) {
            $message->to($email)->subject('Yêu cầu đặt lại mật khẩu');
        });
    }
}
