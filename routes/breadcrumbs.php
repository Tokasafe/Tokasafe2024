<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('dashboard'));
});

// Home > hazard
Breadcrumbs::for('hazard', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Hazard ', route('hazard'));
});

// Home > hazard > [detail]
Breadcrumbs::for('hazard_details', function (BreadcrumbTrail $trail, $h1) {
    $trail->parent('hazard');
    $trail->push('Hazard Detail', route('hazardDetails', $h1));
});

// Home > incident
Breadcrumbs::for('incident', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Incident ', route('incident'));
});
// Home > incident > [detail]
Breadcrumbs::for('incident_details', function (BreadcrumbTrail $trail, $h1) {
    $trail->parent('incident');
    $trail->push('Incident Detail', route('incidentDetails', $h1));
});




// Home > hazardguest
Breadcrumbs::for('hazardGuest', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Hazard ', route('hazardGuest'));
});

// Home > hazardguest > [detail]
Breadcrumbs::for('hazardDetailsGuest', function (BreadcrumbTrail $trail, $h1) {
    $trail->parent('hazardGuest');
    $trail->push('Hazard Detail', route('hazardDetailsGuest', $h1));
});

// Home > incidentGuest
Breadcrumbs::for('incidentGuest', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Incident ', route('incidentGuest'));
});
// Home > incidentGuest > [detail]
Breadcrumbs::for('incidentDetailsGuest', function (BreadcrumbTrail $trail, $h1) {
    $trail->parent('incidentGuest');
    $trail->push('Incident Detail', route('incidentDetailsGuest', $h1));
});
// Home > Manhours
Breadcrumbs::for('manhoursRegister', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Manhours ', route('manhoursRegister'));
});
// Home > ManhoursGuest
Breadcrumbs::for('ManhoursGuest', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Manhours ', route('ManhoursGuest'));
});

