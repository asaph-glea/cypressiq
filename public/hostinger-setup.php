<?php
/**
 * CypressIQ — Hostinger Production Setup Utility
 * 
 * If you do NOT have SSH access on Hostinger, this script allows you to run
 * necessary artisan commands directly from your browser once.
 * 
 * URL: https://yourdomain.com/hostinger-setup.php?key=cypressiq2026
 * 
 * For security, this file automatically disables itself after completion.
 */

$securityToken = 'cypressiq2026';

if (!isset($_GET['key']) || $_GET['key'] !== $securityToken) {
    http_response_code(403);
    die('<h2 style="font-family:sans-serif;color:#ef4444;text-align:center;margin-top:50px">403 Forbidden — Invalid Security Token.</h2>');
}

// Ensure error reporting is visible during setup
error_reporting(E_ALL);
ini_set('display_errors', '1');

// Determine project root directory
$baseDir = dirname(__DIR__);
require_once $baseDir . '/vendor/autoload.php';
$app = require_once $baseDir . '/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CypressIQ — Hostinger Setup Assistant</title>
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; background: #0B0F19; color: #F8FAFC; margin: 0; padding: 40px 20px; }
        .box { max-width: 720px; margin: 0 auto; background: #131A2B; border: 1px solid rgba(255,255,255,0.1); border-radius: 16px; padding: 32px; box-shadow: 0 20px 50px rgba(0,0,0,0.5); }
        h1 { color: #00D4AA; font-size: 24px; margin-top: 0; }
        .log { background: #060913; border: 1px solid rgba(255,255,255,0.08); border-radius: 8px; padding: 16px; font-family: monospace; font-size: 13px; line-height: 1.6; margin: 16px 0; max-height: 350px; overflow-y: auto; color: #94A3B8; }
        .success { color: #34D399; font-weight: 600; }
        .btn { display: inline-block; background: linear-gradient(135deg, #6C63FF, #00D4AA); color: #fff; text-decoration: none; padding: 10px 20px; border-radius: 999px; font-weight: 600; font-size: 14px; margin-top: 10px; }
        .notice { font-size: 12px; color: #F59E0B; margin-top: 15px; }
    </style>
</head>
<body>
    <div class="box">
        <h1>⚡ CypressIQ Production Setup</h1>
        <p style="color:#94A3B8;font-size:14px">Executing essential Laravel production commands...</p>
        
        <div class="log">
            <?php
            function runCommand($kernel, $command, $params = []) {
                echo "<span>Executing: php artisan {$command}...</span><br>";
                try {
                    $status = $kernel->call($command, $params);
                    $output = trim($kernel->output());
                    if ($output) {
                        echo "<span style='color:#cbd5e1'>" . nl2br(htmlspecialchars($output)) . "</span><br>";
                    }
                    echo "<span class='success'>✓ Finished {$command} (Exit code: {$status})</span><br><br>";
                } catch (Throwable $e) {
                    echo "<span style='color:#f87171'>Error executing {$command}: " . htmlspecialchars($e->getMessage()) . "</span><br><br>";
                }
            }

            // 1. Run Migrations
            runCommand($kernel, 'migrate', ['--force' => true]);

            // Optional: Seed Database (Admin, Growth, Engineer, Showcase Projects, Testimonials)
            if (isset($_GET['seed']) && ($_GET['seed'] === '1' || $_GET['seed'] === 'true')) {
                runCommand($kernel, 'db:seed', ['--force' => true]);
            }

            // 2. Storage Link
            runCommand($kernel, 'storage:link');

            // 3. Clear & Build Production Caches
            runCommand($kernel, 'config:cache');
            runCommand($kernel, 'route:cache');
            runCommand($kernel, 'view:cache');
            ?>
        </div>

        <p class="success">🎉 Setup complete! Your CypressIQ platform is now running live on Hostinger.</p>
        <p class="notice">⚠️ Important Security Note: Delete this file (<code>public/hostinger-setup.php</code>) from your Hostinger File Manager now that setup is finished.</p>
        <a href="/" class="btn">Go to Public Homepage →</a>
        <a href="/admin/login" class="btn" style="background:#1E293B;margin-left:8px">Open Admin Login →</a>
    </div>
</body>
</html>
