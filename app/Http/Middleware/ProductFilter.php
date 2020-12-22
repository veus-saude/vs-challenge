<?php

namespace App\Http\Middleware;

use App\Product;
use Closure;

class ProductFilter
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->get('q') && !$request->get('filter')) {
            $response = Product::whereLike(['name', 'brand'], $request->get('q'))->get();
        }

        else if ($request->get('q') && $request->get('filter')) {
            $attribute = strstr($request->get('filter'), ':', true);
            $filter = substr(strstr($request->get('filter'), ':', false), 1);

            $queryAttributes = array('name', 'brand', 'price', 'amount');

            foreach ($queryAttributes as $k => $queryAttribute) {
                if ($queryAttribute === $attribute) {
                    unset($queryAttributes[$k]);
                }
            }
            $response = Product::where($attribute, '=', $filter)->whereLike($queryAttributes, $request->get('q'))->get();
        }


        else {
            $response = Product::all();
        }

        $request->request->add(['data' => $response]);

        return $next($request);
    }
}
