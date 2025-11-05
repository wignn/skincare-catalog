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
        // Ambil REDIS_URL dari .env
        $redisUrl = env('REDIS_URL', 'redis://127.0.0.1:6379');

        // Parse URL redis://user:pass@host:port
        $parts = parse_url($redisUrl);

        $host = $parts['host'] ?? '127.0.0.1';
        $port = $parts['port'] ?? 6379;
        $password = $parts['pass'] ?? null;

        // Konfigurasi Redis adapter Prometheus
        $adapter = new Redis([
            'host' => $host,
            'port' => $port,
            'password' => $password,
        ]);

        $registry = new CollectorRegistry($adapter);

        // Metric: HTTP request counter
        $counter = $registry->getOrRegisterCounter(
            'app',
            'http_requests_total',
            'Total number of HTTP requests',
            ['method', 'route']
        );

        $counter->incBy(1, [request()->method(), request()->path()]);

        // Render output Prometheus
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
