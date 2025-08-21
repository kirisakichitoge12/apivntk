<?php
// app/Http/Middleware/AdminAuth.php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class AdminAuth
{
    public function handle($request, Closure $next)
    {
        if (!Session::has('admin_id')) {
            return redirect('/admin');
        }
        return $next($request);
    }
}
