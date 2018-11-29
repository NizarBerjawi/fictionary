<?php

/**
 * Get the path to a webpack bundle asset
 *
 * @param string $bundle Bundle name
 * @param string $type Asset type to take from the bundle ('js' or 'css')
 * @return string Path to asset
 */
if (! function_exists('webpack')) {
    function webpack(string $bundle, string $type) : string
    {
        $path = public_path('dist/manifest.json');

        if (! File::exists($path)) {
            throw new InvalidArgumentException('Unable to locate webpack manifest');
        }

        $manifest = json_decode(File::get($path));

        if (! isset($manifest->$bundle->$type)) {
            throw new InvalidArgumentException("Unable to find the bundle '$bundle' of type '$type'");
        }

        return url('dist', $manifest->$bundle->$type);
    }
}

/**
 * Generate a class for an HTML element
 *
 * @param array $default The default classes of the element
 * @param array $classes The classes to be appended to the element
 * @return string
 */
if (! function_exists('className')) {
    function className(array $default, array $classes = [])
    {
        $classes = array_merge($default, array_filter($classes));
        return implode(' ', $classes);
    }
}

/**
 * Recursively filter out null values in an array
 *
 * @param array $input
 * @return array $array
 */
if (! function_exists('array_filter_recursive')) {
    function array_filter_recursive(array $input) : array
    {
        foreach ($input as &$value) {
            if (is_array($value)) {
                $value = array_filter_recursive($value);
            }
        }
        return array_filter($input);
    }
}
