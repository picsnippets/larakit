<?php

namespace Buckii\Larakit\Models;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;
use Storage;
use Symfony\Component\HttpFoundation\File\File;
use Response;

class Document extends Model
{
    const STORAGE_DIR = "documents";

    protected $table = 'documents';

    protected $fillable = [
        'display_name',
        'stored_name',
        'mime_type',
        'extension',
    ];

    public static function getStorage()
    {
        return Storage::disk('local');
    }

    /**
     * Stores a file, throws an exception on error.
     *
     * @param string $display_name Display name, do not include extension.
     * @param File $file The file to store.
     *
     * @return Document The stored document
     */
    public static function store($display_name, File $file)
    {
        $storage = self::getStorage();
        $storage->makeDirectory(self::STORAGE_DIR);

        // Generate a unique name for the file
        $stored_name = Uuid::uuid4()->toString();

        // Mime and extension
        $mime_type = $file->getMimeType();
        $extension = $file->guessExtension();
        if (is_null($extension)) {
            $extension = "txt";
        }

        $document = new Document([
            'display_name' => $display_name,
            'stored_name' => $stored_name,
            'mime_type' => $mime_type,
            'extension' => $extension,
        ]);

        // Open the file, pass to flysystem
        $handle = fopen($file->getRealPath(), 'rb');

        if (!$handle) {
            throw new ErrorException('Could not open file: ' . $file->getRealPath());
        }

        $storage->put(
            self::STORAGE_DIR . '/' . $document->getFullStoredName(),
            $handle
        );

        if (is_resource($handle)) {
            fclose($handle);
        }

        // Save the document in the database
        $document->save();

        return $document;
    }

    public static function normalizeName($name)
    {
        // Swap spaces for underscores in original name
        $original_name = preg_replace(
            '/ +/',
            '_',
            $name
        );

        // Yank the extension, if one exists
        $name = pathinfo($original_name, PATHINFO_FILENAME);

        return $name;
    }

    public function getFullDisplayName()
    {
        return $this->display_name . '.' . $this->extension;
    }

    public function getFullStoredName()
    {
        return $this->stored_name . '.' . $this->extension;
    }

    public function getReadStream()
    {
        $storage = self::getStorage();

        return $storage->readStream(self::STORAGE_DIR . '/' . $this->getFullStoredName());
    }

    public function getDownloadResponse()
    {
        return Response::stream(
            function () {
                $docStream = $this->getReadStream();
                $outputStream = fopen('php://output', 'wb');

                stream_copy_to_stream($docStream, $outputStream);
            },
            200,
            [
                'Content-Disposition' => 'attachment; filename=' . $this->getFullDisplayName(),
                'Content-Type' => $this->mime_type,
            ]
        );
    }
}
