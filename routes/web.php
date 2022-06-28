<?php

use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


include ("webRoutes/AdminRoutes.php");
include ("webRoutes/AuthRoutes.php");
include ("webRoutes/CafeRoutes.php");
include ("webRoutes/ClinicRoutes.php");
include ("webRoutes/CostRoutes.php");
include ("webRoutes/DemoRoutes.php");
include ("webRoutes/GateRoutes.php");
include ("webRoutes/IDRoutes.php");
include ("webRoutes/OtherRoutes.php");


