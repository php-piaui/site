<?php

declare(strict_types=1);

use Aws\CommandInterface;
use Aws\MockHandler;
use Aws\Result;
use Aws\S3\Exception\S3Exception;
use Aws\S3\S3Client;
use GuzzleHttp\Psr7\Response;
use Illuminate\Filesystem\AwsS3V3Adapter;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\AwsS3V3\AwsS3V3Adapter as FlysystemAdapter;
use League\Flysystem\Filesystem;

/**
 * Troca o disk s3 por um cliente com respostas simuladas, na ordem, e devolve os nomes dos comandos enviados.
 *
 * @param  list<Result|Closure(CommandInterface): S3Exception>  $responses
 * @return ArrayObject<int, CommandInterface>
 */
function fakeS3Client(array $responses): ArrayObject
{
    $sent    = new ArrayObject();
    $handler = new MockHandler();

    foreach ($responses as $response) {
        $handler->append(function (CommandInterface $command) use ($sent, $response) {
            $sent->append($command);

            return $response instanceof Closure ? $response($command) : $response;
        });
    }

    $client  = new S3Client(['region' => 'us-east-1', 'version' => 'latest', 'credentials' => false, 'handler' => $handler]);
    $adapter = new FlysystemAdapter($client, 'phppiaui');
    Storage::set('s3', new AwsS3V3Adapter(new Filesystem($adapter), $adapter, ['bucket' => 'phppiaui'], $client));
    config(['filesystems.disks.s3.bucket' => 'phppiaui']);

    return $sent;
}

/**
 * @param  ArrayObject<int, CommandInterface>  $sent
 * @return list<string>
 */
function commandNames(ArrayObject $sent): array
{
    return array_values(array_map(fn (CommandInterface $command): string => $command->getName(), $sent->getArrayCopy()));
}

test('creates a missing bucket and opens only the photos folder for reading', function () {
    $sent = fakeS3Client([
        fn (CommandInterface $command) => new S3Exception('Not found', $command, ['response' => new Response(404)]),
        new Result(),
        new Result(),
    ]);

    $this->artisan('storage:bucket')->expectsOutputToContain('Bucket [phppiaui] criado.')->assertSuccessful();

    expect(commandNames($sent))->toBe(['HeadBucket', 'CreateBucket', 'PutBucketPolicy'])
        ->and(json_decode($sent[2]['Policy'], true)['Statement'][0])
        ->Action->toBe(['s3:GetObject'])
        ->Resource->toBe(['arn:aws:s3:::phppiaui/photos/*']);
});

test('keeps an existing bucket and reapplies the policy', function () {
    $sent = fakeS3Client([new Result(), new Result()]);

    $this->artisan('storage:bucket')->expectsOutputToContain('Bucket [phppiaui] já existe.')->assertSuccessful();

    expect(commandNames($sent))->toBe(['HeadBucket', 'PutBucketPolicy']);
});

test('fails without a configured bucket', function () {
    config(['filesystems.disks.s3.bucket' => null]);

    $this->artisan('storage:bucket')->expectsOutputToContain('AWS_BUCKET')->assertFailed();
});
