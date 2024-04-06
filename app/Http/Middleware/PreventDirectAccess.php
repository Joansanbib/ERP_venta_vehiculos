<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PreventDirectAccess
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->ajax() && !$request->wantsJson() && !$this->isJavaScriptRedirect($request)) {
            // Si la solicitud no es Ajax, no quiere JSON y no es una redirección de JavaScript,
            // redirecciona a una página de error o a donde desees.
            return redirect('/'); // Por ejemplo, podrías redireccionar a una página de error 404.
        }

        return $next($request);
    }

    protected function isJavaScriptRedirect($request)
    {
        return $request->headers->get('referer') && strpos($request->headers->get('referer'), url('/')) !== false;
    }
}
