<?php
/**
 * Created by PhpStorm.
 * User: lcm
 * Date: 16-8-23
 * Time: 下午4:53
 */

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

class BaseMiddleware {

    protected $_request_begin_time;
    protected $_request_end_time;
    /**
     * @param \Illuminate\Http\Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /*
         * controller 第一个字母大写
         * action 全小写,action为空则默认为index
         */
        $request->route()->setParameter('controller', ucwords(camel_case($request->controller)));
        if(isset($request->action)) {
            $request->route()->setParameter('action', camel_case($request->action));
        }

        $this->beforeRequest($request);
        $response = $next($request);
        $response = $this->afterRequest($request, $response);
        return $response;
    }

    /**
     * @param \Illuminate\Http\Request $request
     */
    protected function beforeRequest($request)
    {
        Log::info('-----------REQUEST BEGIN-----------');
        list($tmp1, $tmp2) = explode(' ', microtime());
        $this->_request_begin_time = $tmp1 + $tmp2;
    }

    protected function afterRequest($request, $response)
    {
        list($tmp1, $tmp2) = explode(' ', microtime());
        $this->_request_end_time = $tmp1 + $tmp2;

        //记录运行时间与运行内存
        $time = sprintf("%.3f", $this->_request_end_time - $this->_request_begin_time);
        $memory = round(memory_get_usage()/1024/1024, 3);
        Log::info('RUN INFO', ['time' => $time.'s', 'memory' => $memory.'M']);

        Log::info('-----------REQUEST END-----------');
        return $response;
    }
}