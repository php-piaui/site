<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Filesystem\AwsS3V3Adapter;
use Illuminate\Support\Facades\Storage;

/**
 * Prepara o bucket do disk s3 (RustFS no Sail, ou o provedor S3 de produção): cria se faltar e libera leitura pública
 * só das fotos de perfil. Idempotente, pode rodar a cada deploy.
 */
#[Signature('storage:bucket')]
#[Description('Cria o bucket S3 e libera leitura pública das fotos de perfil')]
class CreateStorageBucket extends Command
{
    public function handle(): int
    {
        $bucket = config('filesystems.disks.s3.bucket');
        $disk   = is_string($bucket) && $bucket !== '' ? Storage::disk('s3') : null;

        if (! $disk instanceof AwsS3V3Adapter) {
            $this->components->error('Configure o disk s3 e AWS_BUCKET no .env.');

            return self::FAILURE;
        }

        $client = $disk->getClient();

        if ($client->doesBucketExist($bucket)) {
            $this->components->info("Bucket [{$bucket}] já existe.");
        } else {
            $client->createBucket(['Bucket' => $bucket]);
            $this->components->info("Bucket [{$bucket}] criado.");
        }

        $client->putBucketPolicy([
            'Bucket' => $bucket,
            'Policy' => json_encode([
                'Version'   => '2012-10-17',
                'Statement' => [[
                    'Effect'    => 'Allow',
                    'Principal' => ['AWS' => ['*']],
                    'Action'    => ['s3:GetObject'],
                    'Resource'  => ["arn:aws:s3:::{$bucket}/".User::PHOTO_DIRECTORY.'/*'],
                ]],
            ], JSON_THROW_ON_ERROR),
        ]);
        $this->components->info('Leitura pública liberada em '.User::PHOTO_DIRECTORY.'/*.');

        return self::SUCCESS;
    }
}
