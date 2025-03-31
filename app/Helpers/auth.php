if (!function_exists('is_supervisor_logged_in')) {
    function is_supervisor_logged_in()
    {
        return Auth::guard('supervisor')->check();
    }
}