# eppeianta

Single file PHP platform to enable pure JavaScript MVC development:

Supports
============
- standards compliant routes (http://url.com/admin/login)
- SEO friendly output for search engines (see extended folder)
- $_GET and $_POST variables available as JS variables

How it works
============
Simple route naming convention -- controller_name/method_name --
specifies, which controller and method to be called

- /               will call GuestController.home();
- /login          will call GuestController.login();
- /admin/login    will call AdminController.login();
- /admin/register will call AdminController.register();
