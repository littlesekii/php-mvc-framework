<?php

class FakeController {
    public function index() {}
    public function show($id) {}
}

$totalRoutes = 1000;
$totalIterations = 120;

// 🔥 STATIC
$start = microtime(true);

for ($i = 0; $i < $totalIterations; $i++) {

    $staticRoutes = ['GET' => []];

    for ($r = 1; $r <= $totalRoutes; $r++) {
        $staticRoutes['GET']["/users{$r}"] = [
            'action' => [FakeController::class, 'index']
        ];
    }

    $uri = "/users{$totalRoutes}";
    $route = $staticRoutes['GET'][$uri] ?? null;

    if ($route) {
        $action = $route['action'];
    }
}

$staticTime = microtime(true) - $start;


// // 🔥 DYNAMIC (agora com action também)
// $start = microtime(true);

// for ($i = 0; $i < $totalIterations; $i++) {

//     $dynamicRoutes = ['GET' => []];

//     for ($r = 1; $r <= $totalRoutes; $r++) {

//         $pattern = "#^/users{$r}/([^/]+)$#";

//         $dynamicRoutes['GET'][] = [
//             'pattern' => $pattern,
//             'action' => [FakeController::class, 'show']
//         ];
//     }

//     $uri = "/users{$totalRoutes}/123";

//     foreach ($dynamicRoutes['GET'] as $route) {
//         if (preg_match($route['pattern'], $uri, $matches)) {
//             $action = $route['action'];
//             break;
//         }
//     }
// }

// $dynamicTime = microtime(true) - $start;

echo "Static:  {$staticTime}\n";
echo "Dynamic: {$dynamicTime}\n";