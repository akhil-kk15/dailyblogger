<?php

if (!function_exists('setting')) {
    /**
     * Get a setting value by key
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    function setting($key, $default = null)
    {
        return \App\Models\Setting::get($key, $default);
    }
}

if (!function_exists('set_setting')) {
    /**
     * Set a setting value
     *
     * @param string $key
     * @param mixed $value
     * @param string $type
     * @param string|null $group
     * @param string|null $description
     * @return \App\Models\Setting
     */
    function set_setting($key, $value, $type = 'string', $group = null, $description = null)
    {
        return \App\Models\Setting::set($key, $value, $type, $group, $description);
    }
}
