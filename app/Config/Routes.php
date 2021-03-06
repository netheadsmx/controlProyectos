<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/auth/register','auth/Register::index');
$routes->get('/auth/login','auth/Login::index');
$routes->get('/dashboard/start', 'Dashboard/Dashboard::index');
$routes->get('/dashboard/colabs', 'Dashboard/Colabs::index');
$routes->get('/dashboard/getcolabs', 'Dashboard/Colabs::getColabs');
$routes->get('/dashboard/getSolicitudes', 'Dashboard/Colabs::getSolicitudes');
$routes->get('/auth/register/check_user_data','auth/Register::check_user_data');
$routes->get('/auth/register/company','auth/Register::company');
$routes->get('/auth/register/new','auth/Register::new');
$routes->get('/auth/register/check_new_company','auth/Register::check_new_company');
$routes->get('/auth/register/join','auth/Register::join');
$routes->get('/auth/register/end','auth/Register::end');
$routes->get('/auth/check_user','auth/Login::check_user');
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
