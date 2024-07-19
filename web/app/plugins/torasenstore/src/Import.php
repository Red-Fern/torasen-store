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

    public function getExistingFile(string $file): ?string
    {
        $fileTitle = pathinfo($file, PATHINFO_FILENAME);
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
        try {
            $skus = [];
            $csv = Reader::createFromPath($this->csvPath, 'r');
            $csv->setHeaderOffset(0);
            $records = $csv->getRecords();
            foreach ($records as $record) {
                if ($record['Parent Product SKU'] != 0) {
                    $sku = trim($record['SKU']);
                    $skus[$sku] = $record['Images'];
                }
            }

            \WP_CLI::log("found " . count($skus) . " images to attach\n");

            $statuses = array('publish', 'draft');
            // Args on the main query for WC_Product_Query
            $args = [
                'status'    => $statuses,
                'orderby'   => 'name',
                'order'     => 'ASC',
                'limit'     => -1,
            ];

            $vendor_products = wc_get_products($args);
            foreach ($vendor_products as $key => $product) {
                if ($product->get_type() == "variable") {
                    // Args on product variations query for a variable product using a WP_Query
                    $args2 = array(
                        'post_parent' => $product->get_id(),
                        'post_type'   => 'product_variation',
                        'orderby'     => array( 'menu_order' => 'ASC', 'ID' => 'ASC' ),
                        'fields'      => 'ids',
                        'post_status' => $statuses,
                        'numberposts' => -1,
                    );

                    foreach ( get_posts( $args2 ) as $child_id ) {
                        // get an instance of the WC_Variation_product Object
                        $variation = wc_get_product( $child_id );

                        if ( ! $variation || ! $variation->exists() || !array_key_exists($variation->get_sku(),$skus) ) {
                            \WP_CLI::warning("Variation not found for SKU: " . $product->get_sku());
                            continue;
                        }

                        $images = explode('|', $skus[$variation->get_sku()]);
                        $imageIds = [];
                        foreach ($images as $image) {
                            $imageId = $this->getExistingFile($image);
                            if ($imageId) {
                                $imageIds[] = $imageId;
                            }else{
                                \WP_CLI::warning("Image not found in media library: " . $image);
                            }
                        }
                        if (count($imageIds) == 0) {
                            \WP_CLI::warning("no images for SKU: " . $variation->get_sku());
                            continue;
                        }

                        $variation->delete_meta_data('variation_media_gallery');
                        usleep(10000);
                        $variation->set_gallery_image_ids($imageIds);
                        $variation->save();
                    }
                }else{
                    //\WP_CLI::warning("Not variable product: " . $product->get_sku());
                }
            }
        } catch (\Exception $e) {
            \WP_CLI::error($e->getMessage());
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
        die();
    }
}

$instance = new Import('');
\WP_CLI::add_command('product-image-import', $instance, ['shortdesc'=>'Import product variation images']);
