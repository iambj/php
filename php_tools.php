<?php

$directlyLoaded = false; //-- Whether this file was directly navigated to within the browser for testing

if(count(get_included_files()) === 1){
    $directlyLoaded = true;
    echo "<h1>Loaded PHPTools</h1>";
    include_once("inc/.serverConf.ini");
    //-- Define some needed vars, otherwise include in .serverConf.ini
    // define("ROOT","/var/www/html/inc");
    // define("MAIN","/var/www/html");

}

/**
 * Takes data and prints to the screen in between <pre> tags. 
 *
 * @param any $msg
 * @return void
 */
function print_pre($msg){
    echo "<pre>";
    print_r($msg);
    echo "</pre>";
}

/**
 * If the logger class is unavailable, will load it, otherwise will just return the instance of it,
 * with the PHP TOOLS log location. 
 *
 * @return object
 */
function includeLogging(){
    global $ROOT;
    // error_log("***PHP TOOL LOGGER***");
    if(!class_exists('logger')){
        include_once(ROOT . "/class/logger.php");
    }
    //-- TODO could create a nice new log function for the way we want it, ie-  no line breaks, nice borders
    $logger = new \logger();
    $logger->setLogFile("debugPHP_TOOLS.log");
    $logger->loggit("PHP TOOLS LOGGER LOADED");
    return $logger;
    
}


/**
 * Turns on all errors and displays them to the user
 *
 * @param boolean $on
 * @return void
 */
function forceDebugging(){
    ini_set('display_errors', 1);
    ini_set('html_errors', 1); // Show nice HTML errors
    error_reporting(E_ALL);
}

/**
 * Print to the browsers console
 *
 * @param any $data
 * @param bool $tags If true print <script> tags
 * @return void
 */
function consoleLog($data, $tags = false){
    echo $tags === true ? '<script>' : null;
    echo 'console.dir('. json_encode($data) .');';
    echo $tags === true ? '</script>' : null;
  }

/*
    TODO: add variables and tracing
    
    var_dump ($var) dumps the variable type and value to stdout.
    print_r ($var) prints the variable value in human-readable form to stdout.
    get_defined_vars() gets all the defined variables including built-ins and custom variables (print_r to view them).
    debug_zval_dump ($var) dumps the variable with its reference counts. This is useful when there are multiple paths to update a single reference.
    debug_print_backtrace() prints a backtrace that shows the current function call-chain.
    debug_backtrace() gets the backtrace. You can print_r, log it to a file, or send it to a logging endpoint asynchronously.

    get_included_files(); - check for included files

    phpinfo() ; click for info

*/

if($directlyLoaded){
?>

    <div class="tools">
        <a href="<?php echo basename(__FILE__) . "?phpinfo=true"; ?>">PHPInfo()</a>
    </div>

    <div class="phpinfo">
        <?php
            if(isset($_GET["phpinfo"]) && $_GET["phpinfo"] === "true"){
                phpinfo();
            }
        ?>
    </div>

<?php

  

}

?>