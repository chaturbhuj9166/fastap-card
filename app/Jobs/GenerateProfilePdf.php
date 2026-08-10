<?php

namespace App\Jobs;

use App\Models\ProfilePdfJob;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Process\Process;

class GenerateProfilePdf implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $timeout = 120;

    public function __construct(private int $jobId)
    {
    }

    public function handle(): void
    {
        $job = ProfilePdfJob::find($this->jobId);
        if (!$job) {
            return;
        }

        $job->update(['status' => 'processing', 'error_message' => null]);

        $chromePath = $this->resolveChromePath();
        if (!$chromePath) {
            $job->update(['status' => 'failed', 'error_message' => 'Chrome/Edge not found on server.']);
            return;
        }

        $tempPdf = tempnam(sys_get_temp_dir(), 'fastap-profile-') . '.pdf';
        $profileUrl = $job->profile_url;

        $process = new Process([
            $chromePath,
            '--headless',
            '--disable-gpu',
            '--no-sandbox',
            '--disable-dev-shm-usage',
            '--print-to-pdf-no-header',
            '--print-to-pdf=' . $tempPdf,
            $profileUrl,
        ]);
        $process->setTimeout(120);
        $process->run();

        if (!$process->isSuccessful() || !file_exists($tempPdf)) {
            $job->update([
                'status' => 'failed',
                'error_message' => $process->getErrorOutput() ?: 'PDF generation failed.',
            ]);
            @unlink($tempPdf);
            return;
        }

        Storage::disk('public')->makeDirectory('profile-pdfs');
        $filename = ($job->slug ?: 'profile') . '-' . date('YmdHis') . '.pdf';
        $path = 'profile-pdfs/' . $filename;
        Storage::disk('public')->put($path, file_get_contents($tempPdf));
        @unlink($tempPdf);

        $job->update([
            'status' => 'ready',
            'file_path' => $path,
            'error_message' => null,
        ]);
    }

    private function resolveChromePath(): ?string
    {
        $envPath = env('PDF_CHROME_PATH');
        if ($envPath && file_exists($envPath)) {
            return $envPath;
        }

        $candidates = [
            'C:\\Program Files\\Google\\Chrome\\Application\\chrome.exe',
            'C:\\Program Files (x86)\\Google\\Chrome\\Application\\chrome.exe',
            'C:\\Program Files\\Microsoft\\Edge\\Application\\msedge.exe',
            'C:\\Program Files (x86)\\Microsoft\\Edge\\Application\\msedge.exe',
        ];

        foreach ($candidates as $candidate) {
            if (file_exists($candidate)) {
                return $candidate;
            }
        }

        return null;
    }
}
