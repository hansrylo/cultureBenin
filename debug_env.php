<?php
echo "Cloud Name: " . env('CLOUDINARY_CLOUD_NAME') . "\n";
echo "API Key: " . env('CLOUDINARY_API_KEY') . "\n";
echo "API Secret: " . (env('CLOUDINARY_API_SECRET') ? '***' : 'Missing') . "\n";
echo "URL: " . env('CLOUDINARY_URL') . "\n";
echo "\n--- .env content ---\n";
echo file_get_contents('.env');
