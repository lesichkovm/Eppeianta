<?php
error_reporting(E_ALL);
ini_set('display_errors', true);
ini_set('display_startup_errors', true);
defined('ROOT_URL') OR define('ROOT_URL', 'http://myurl.com');
defined('ROOT_DIR') OR define('ROOT_DIR', __DIR__);

list($controller, $method) = action();

$cssFiles = [
    ROOT_URL . '/css/font-awesome-4-3-0.css',
    ROOT_URL . '/css/bootstrap-3-2-0.min.css',
    ROOT_URL . '/css/bootstrap-sandstone-3-2-0.min.css',
];
$javascriptFiles = [
    ROOT_URL . '/js/lib/jquery.js',
    ROOT_URL . '/js/lib/bootstrap-3-2-0.min.js',
    ROOT_URL . '/js/Registry.js',
    ROOT_URL . '/js/Helper.js',
    ROOT_URL . '/js/controllers/GuestController.js',
    ROOT_URL . '/js/controllers/AuthController.js',
];
?>
<!DOCTYPE html>
<title></title>
<meta charset="UTF-8">
<meta name="fragment" content="!">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="icon" type="image/png" href="<?php echo ROOT_URL; ?>img/icon.png" />
<?php foreach ($cssFiles as $f) { ?>
    <link rel="stylesheet" href="<?php echo $f ?>" />
<?php } ?>
<?php foreach ($javascriptFiles as $f) { ?>
    <script src="<?php echo $f ?>"></script>
<?php } ?>
<script>
    var $_GET = <?php echo json_encode($_GET); ?>;
    var $_POST = <?php echo json_encode($_POST); ?>;
    var rootUrl = '<?php echo ROOT_URL; ?>';
    $(function () {
        <?php echo $controller; ?>.<?php echo $method; ?>();
    });
</script>
<?php
exit;

/* START: PRIVATE FUNCTIONS */

/**
 * This function will recognize the action to be executed by JavaScript
 * depending on the URI used. It will return an array with two entries
 * controller and method.
 * <code>
 * list(controller,method) = action(route);
 * </code>
 * @param string $route
 * @return array
 */
function action($route = '') {

    function camelize($string, $first_char_caps = false) {
        if ($first_char_caps == true) {
            $string[0] = strtoupper($string[0]);
        }
        $func = create_function('$c', 'return strtoupper($c[1]);');
        return preg_replace_callback('/_([a-z])/', $func, $string);
    }

    $route = $route != '' ? $route : isset($_REQUEST['a']) ? $_REQUEST['a'] : '';
    $path = explode('/', $route);
    $method = trim(str_replace('-', '_', array_pop($path)));
    $controller = trim(implode('_', $path));
    if ($method == '') {
        $method = 'home';
    }
    if ($controller == '') {
        $controller = 'Guest';
    }
    $controllerCamelized = camelize($controller, true) . 'Controller';
    $methodCamelized = camelize($method);
    return [$controllerCamelized, $methodCamelized];
}
/* END: PRIVATE FUNCTIONS */
?>
