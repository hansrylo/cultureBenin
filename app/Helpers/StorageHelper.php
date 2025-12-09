<?php

if (!function_exists('safe_storage_url')) {
    /**
     * Get a safe storage URL, falling back to public disk if the configured disk doesn't exist
     *
     * @param string $path
     * @param string|null $disk
     * @return string
     */
    function safe_storage_url($path, $disk = null)
    {
        if (!$path) {
            return '';
        }

        try {
            $disk = $disk ?? config('filesystems.default');
            
            // Check if disk exists in config
            if (!config("filesystems.disks.{$disk}")) {
                $disk = 'public';
            }
            
            return \Storage::disk($disk)->url($path);
        } catch (\Exception $e) {
            // Fallback to public disk
            try {
                return \Storage::disk('public')->url($path);
            } catch (\Exception $e2) {
                // Last resort: return the path as-is
                return '/storage/' . $path;
            }
        }
    }
}
