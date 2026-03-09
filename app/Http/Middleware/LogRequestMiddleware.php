<?php

namespace App\Http\Middleware;

use App\Core\Logger;
use App\Core\Middleware;
use App\Core\Request;

class LogRequestMiddleware implements Middleware {

	public function handle(Request $request, callable $next) {
        Logger::info($request->method() . ' ' . $request->uri());
		return $next($request);
	}
}