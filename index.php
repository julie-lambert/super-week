<?php
//*                    // Match all request URIs
//[i]                  // Match an integer
//[i:id]               // Match an integer as 'id'
//[a:action]           // Match alphanumeric characters as 'action'
//[h:key]              // Match hexadecimal characters as 'key'
//[:action]            // Match anything up to the next / or end of the URI as 'action'
//[create|edit:action] // Match either 'create' or 'edit' as 'action'
//[*]                  // Catch all (lazy, stops at the next trailing slash)
//[*:trailing]         // Catch all as 'trailing' (lazy)
//[**:trailing]        // Catch all (possessive - will match the rest of the URI)
//.[:format]?          // Match an optional parameter 'format' - a / or . before the block is also optional


require 'vendor/autoload.php';

$router = new AltoRouter();

$router->setBasePath('/super-week');

$router->map('GET', '/', function(){
    echo "<h1>Bienvenue sur l'accueil";
},'index');

$router->map('GET', '/users', function(){
    echo "<h1>Bienvenue sur la liste des Utilisateurs";
},'users');

$router->map('GET', '/users/[i:id]', function($id){
    echo "<h1>Bienvenue sur la page de l'utilisateur" . $id . "<h1>";
},'users/id');

$match = $router->match();


if( is_array($match) && is_callable( $match['target'] ) ) {
	call_user_func_array( $match['target'], $match['params'] ); 
} else {
	// no route was matched
	header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
}

?>