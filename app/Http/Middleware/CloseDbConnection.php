<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;

class CloseDbConnection
{
    public function handle($request, Closure $next)
    {
        Log::info('DB Connection Open', [
            'url' => $request->fullUrl(),
            'method' => $request->method(),
            'time' => now()->toDateTimeString()
        ]);

        $response = $next($request);

        // Close connection
        DB::disconnect();

        return $response;
    }
}
