<?php

namespace App\Http\Controllers;

use Prometheus\CollectorRegistry;
use Prometheus\RenderTextFormat;
use Prometheus\Storage\Redis;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class MetricsController extends Controller
{
    public function metrics()
    {
        $host = env('REDIS_HOST', '127.0.0.1');
        $port = env('REDIS_PORT', 6379);
        $password = env('REDIS_PASSWORD');

        $redisConfig = [
            'host' => $host,
            'port' => (int) $port,
        ];

        if ($password && $password !== 'null') {
            $redisConfig['password'] = $password;
        }

        $adapter = new Redis($redisConfig);

        $registry = new CollectorRegistry($adapter);

        $counter = $registry->getOrRegisterCounter(
            'app',
            'http_requests_total',
            'Total number of HTTP requests',
            ['method', 'route']
        );

        $counter->incBy(1, [request()->method(), request()->path()]);

        $renderer = new RenderTextFormat();
        return response($renderer->render($registry->getMetricFamilySamples()))
            ->header('Content-Type', RenderTextFormat::MIME_TYPE);
    }

    /**
     * Health check endpoint
     */
    public function health()
    {
        $status = [
            'status' => 'healthy',
            'timestamp' => now()->toIso8601String(),
            'checks' => []
        ];

        // Database check
        try {
            DB::connection()->getPdo();
            $status['checks']['database'] = 'ok';
        } catch (\Exception $e) {
            $status['checks']['database'] = 'failed';
            $status['status'] = 'unhealthy';
        }

        // Cache check
        try {
            Cache::put('health_check', true, 10);
            $cacheWorks = Cache::get('health_check');
            $status['checks']['cache'] = $cacheWorks ? 'ok' : 'failed';
        } catch (\Exception $e) {
            $status['checks']['cache'] = 'failed';
        }

        $httpStatus = $status['status'] === 'healthy' ? 200 : 503;

        return response()->json($status, $httpStatus);
    }

    /**
     * Readiness probe - check if app is ready to receive traffic
     */
    public function ready()
    {
        // Check critical dependencies
        try {
            DB::connection()->getPdo();
            return response()->json(['status' => 'ready'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'not ready'], 503);
        }
    }

    /**
     * Liveness probe - check if app is running
     */
    public function alive()
    {
        return response()->json(['status' => 'alive'], 200);
    }
}
