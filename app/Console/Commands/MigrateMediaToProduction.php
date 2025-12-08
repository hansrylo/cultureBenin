<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class MigrateMediaToProduction extends Command
{
    protected $signature = 'media:migrate {url} {--token=}';
    protected $description = 'Migrate local media files to production server';

    public function handle()
    {
        $productionUrl = $this->argument('url');
        $token = $this->option('token') ?? env('MIGRATION_TOKEN', 'your-secret-token');
        
        // Get all files from local storage
        $files = Storage::disk('public')->files('medias');
        
        if (empty($files)) {
            $this->error('No media files found in storage/app/public/medias/');
            return 1;
        }
        
        $this->info("Found " . count($files) . " files to migrate");
        $this->newLine();
        
        $progressBar = $this->output->createProgressBar(count($files));
        $progressBar->start();
        
        $success = 0;
        $failed = 0;
        $errors = [];
        
        foreach ($files as $file) {
            try {
                $filePath = Storage::disk('public')->path($file);
                
                if (!file_exists($filePath)) {
                    $failed++;
                    $errors[] = "File not found: {$file}";
                    $progressBar->advance();
                    continue;
                }
                
                // Upload file to production
                $response = Http::attach(
                    'file', 
                    file_get_contents($filePath), 
                    basename($file)
                )
                ->withHeaders([
                    'Authorization' => 'Bearer ' . $token,
                ])
                ->post($productionUrl . '/api/media/upload', [
                    'path' => $file,
                ]);
                
                if ($response->successful()) {
                    $success++;
                } else {
                    $failed++;
                    $errors[] = "Failed to upload {$file}: " . $response->body();
                }
                
            } catch (\Exception $e) {
                $failed++;
                $errors[] = "Error uploading {$file}: " . $e->getMessage();
            }
            
            $progressBar->advance();
        }
        
        $progressBar->finish();
        $this->newLine(2);
        
        // Summary
        $this->info("Migration completed!");
        $this->info("✓ Successfully uploaded: {$success} files");
        
        if ($failed > 0) {
            $this->error("✗ Failed: {$failed} files");
            $this->newLine();
            
            if ($this->confirm('Show error details?', true)) {
                foreach ($errors as $error) {
                    $this->error($error);
                }
            }
        }
        
        return $failed > 0 ? 1 : 0;
    }
}
