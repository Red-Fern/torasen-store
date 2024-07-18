<?php

namespace RedFern\TorasenStore;

use League\Csv\Reader;

class Import
{
    private string $imageDir;
    private string $csvPath;

    public function __construct($imageDir)
    {
        $uploads = wp_get_upload_dir();
        if (!is_dir($imageDir)) {
            $this->imageDir = $uploads['basedir'] . '/product_images';
        } else {
            $this->imageDir = $imageDir;
        }
        $this->csvPath = $uploads['basedir'] . '/product_images.csv';
    }

    public function getExistingFile(string $file, $full_path = true): ?string
    {
        if ($full_path) {
            $fileTitle = pathinfo($file, PATHINFO_FILENAME);
        } else {
            $fileTitle = $file;
        }
        global $wpdb;
        $query = $wpdb->prepare(
            "SELECT ID FROM $wpdb->posts WHERE post_type = 'attachment' AND post_title = %s",
            $fileTitle
        );
        return $wpdb->get_var($query);
    }

    public function processImage($file, $filePath, $fileExtension): void
    {
        $existingFileId = $this->getExistingFile($file);
        if ($existingFileId) {
            throw new \Exception("File already exists in the media library: " . $file);
        }

        $mimeType = "image/" . ($fileExtension == "jpg" ? "jpeg" : $fileExtension);
        $fileData = [
            "name" => basename($filePath),
            "type" => $mimeType,
            "tmp_name" => $filePath,
            "error" => 0,
            "size" => filesize($filePath)
        ];

        if (is_wp_error($fileData)) {
            throw new \Exception(
                "Error uploading file: " . $fileData->get_error_message()
            );
        }

        $attachmentId = media_handle_sideload($fileData, 0);
        // Check for errors
        if (is_wp_error($attachmentId)) {
            throw new \Exception(
                "Error uploading file: " . $attachmentId->get_error_message()
            );
        } else {
            echo "Uploaded " .
                basename($filePath) .
                " successfully! Attachment ID: " .
                $attachmentId .
                "\n";
        }
    }

    public function import()
    {
        if ($handle = opendir($this->imageDir)) {
            while (false !== ($file = readdir($handle))) {
                $fileExtension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                if (in_array($fileExtension, ["jpg", "jpeg", "png"])) {
                    $filePath = $this->imageDir . "/" . $file;
                    if (file_exists($filePath)) {
                        try {
                            $this->processImage($file, $filePath, $fileExtension);
                        } catch (\Exception $exception) {
                            echo $exception->getMessage();
                            continue;
                        }
                    }
                }
            }

            closedir($handle);
        }
    }

    private function attach()
    {
        $csv = Reader::createFromPath($this->csvPath, 'r');
        $csv->setHeaderOffset(0);
        $header = $csv->getHeader(); //returns the CSV header record
        $records = $csv->getRecords();
        foreach ($records as $record) {
            if ($record['Parent Product SKU'] != 0) {
                $sku = trim($record['SKU']);
                $product_id = wc_get_product_id_by_sku($sku);
                if ($product_id) {
                    $images = explode(',', $record['Images']);
                    $imageIds = [];
                    foreach ($images as $image) {
                        $imageId = $this->getExistingFile($image, false);
                        if ($imageId) {
                            $imageIds[] = $imageId;
                        }
                    }
                    if (count($imageIds) == 0) {
                        continue;
                    }
                    $variation = wc_get_product($product_id);
                    // Remove legacy meta field.
                    $variation->delete_meta_data('variation_media_gallery');
                    usleep(10000);
                    $variation->set_gallery_image_ids($imageIds);
                    $variation->save();
                }
            }
        }
    }

    public function __invoke($args)
    {
        \WP_CLI::log("starting...\n");
        \WP_CLI::log("Loading images...\n");
        $this->import();
        \WP_CLI::success("Import complete!\n");
        \WP_CLI::log("Starting attachment...\n");
        $this->attach();
        \WP_CLI::success("Done!\n");
    }
}

$instance = new Import('');
\WP_CLI::add_command('product-image-import', $instance, ['shortdesc'=>'Import product variation images']);
