<?php
/**
 * PHP file to use when rendering the block type on the server to show on the front end.
 *
 * The following variables are exposed to the file:
 *     $attributes (array): The block attributes.
 *     $content (string): The block default content.
 *     $block (WP_Block): The block instance.
 *
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */
?>

<div <?php echo get_block_wrapper_attributes(); ?>>
    <div x-data="{ currentTab: 'essentials' }">
        <div class="flex flex-wrap justify-between gap-md | lg:flex-nowrap">
            <?php if ($attributes['title']) : ?>
                <h2 class="mb-0"><?php echo $attributes['title']; ?></h2>
            <?php endif; ?>

            <div class="flex gap-sm w-full | lg:w-auto">
                <button 
                    class="bg-transparent text-lg font-medium" 
                    :class="currentTab == 'essentials' ? 'text-black' : 'text-dark-grey'"
                    @click="currentTab = 'essentials'"
                >
                    Essentials
                </button>

                <button 
                    class="bg-transparent text-lg font-medium" 
                    :class="currentTab == 'essentials-home' ? 'text-black' : 'text-dark-grey'"
                    @click="currentTab = 'essentials-home'"
                >
                    Essentials Home
                </button>
            </div>
        </div>

        <div 
            class="mt-md border-t border-mid-grey"
            x-show="currentTab === 'essentials'"
        >
            <div class="flex flex-wrap items-center gap-sm py-xs border-b border-mid-grey | lg:flex-nowrap">
                <div class="w-full text-lg font-medium | lg:w-1/5">
                    Chairs
                </div>

                <div class="w-full flex gap-sm overflow-x-scroll | lg:flex-wrap lg:w-4/5 lg:justify-end">
                   
                        <div class="shrink-0 w-[150px] h-[150px] bg-lightest-grey">
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/products/saturn.jpg'); ?>" alt="" class="wp-image-1526"/>
                        </div>
                        <div class="shrink-0 w-[150px] h-[150px] bg-lightest-grey">
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/products/saturn-mesh.jpg'); ?>" alt="" class="wp-image-1526"/>
                        </div>
                        <div class="shrink-0 w-[150px] h-[150px] bg-lightest-grey">
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/products/saturn-flex.jpg'); ?>" alt="" class="wp-image-1526"/>
                        </div>
                        <div class="shrink-0 w-[150px] h-[150px] bg-lightest-grey">
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/products/eclipse.jpg'); ?>" alt="" class="wp-image-1526"/>
                        </div>
                        <div class="shrink-0 w-[150px] h-[150px] bg-lightest-grey">
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/products/industrial.jpg'); ?>" alt="" class="wp-image-1526"/>
                        </div>
                        <div class="shrink-0 w-[150px] h-[150px] bg-lightest-grey">
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/products/etcetera.jpg'); ?>" alt="" class="wp-image-1526"/>
                        </div>
                    
                </div>
            </div>

            <div class="flex flex-wrap items-center gap-sm py-xs border-b border-mid-grey | lg:flex-nowrap">
                <div class="w-full text-lg font-medium | lg:w-1/5">
                    Desks
                </div>

                <div class="w-full flex gap-sm overflow-x-scroll | lg:flex-wrap lg:w-4/5 lg:justify-end">
                    
                        <div class="shrink-0 w-[150px] h-[150px] bg-lightest-grey">
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/products/apsen-standalone-compact.jpg'); ?>" alt="" class="wp-image-1526"/>
                        </div>
                        <div class="shrink-0 w-[150px] h-[150px] bg-lightest-grey">
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/products/aspen-standalone.jpg'); ?>" alt="" class="wp-image-1526"/>
                        </div>
                        <div class="shrink-0 w-[150px] h-[150px] bg-lightest-grey">
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/products/aspen-in-line.jpg'); ?>" alt="" class="wp-image-1526"/>
                        </div>
                        <div class="shrink-0 w-[150px] h-[150px] bg-lightest-grey">
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/products/aspen-back-to-back.jpg'); ?>" alt="" class="wp-image-1526"/>
                        </div>
                        <div class="shrink-0 w-[150px] h-[150px] bg-lightest-grey">
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/products/aspen-height-adjustable.jpg'); ?>" alt="" class="wp-image-1526"/>
                        </div>
                    
                </div>
            </div>

            <div class="flex flex-wrap items-center gap-sm py-xs border-b border-mid-grey | lg:flex-nowrap">
                <div class="w-full text-lg font-medium | lg:w-1/5">
                    Storage
                </div>

                <div class="w-full flex gap-sm overflow-x-scroll | lg:flex-wrap lg:w-4/5 lg:justify-end">
                    
                        <div class="shrink-0 w-[150px] h-[150px] bg-lightest-grey">
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/products/aspen-pedestal.jpg'); ?>" alt="" class="wp-image-1526"/>
                        </div>
                        <div class="shrink-0 w-[150px] h-[150px] bg-lightest-grey">
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/products/aspen-storage.jpg'); ?>" alt="" class="wp-image-1526"/>
                        </div>
                    
                </div>
            </div>
        </div>

        <div 
            class="mt-md border-t border-mid-grey"
            x-show="currentTab === 'essentials-home'"
            x-cloak
        >
            <div class="flex flex-wrap items-center gap-sm py-xs border-b border-mid-grey | lg:flex-nowrap">
                <div class="w-full text-lg font-medium | lg:w-1/5">
                    Chairs
                </div>

                <div class="w-full flex gap-sm overflow-x-scroll | lg:flex-wrap lg:w-4/5 lg:justify-end">
                    
                        <div class="shrink-0 w-[150px] h-[150px] bg-lightest-grey">
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/products/home-saturn.jpg'); ?>" alt="" class="wp-image-1526"/>
                        </div>
                        <div class="shrink-0 w-[150px] h-[150px] bg-lightest-grey">
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/products/home-saturn-mesh.jpg'); ?>" alt="" class="wp-image-1526"/>
                        </div>
                        <div class="shrink-0 w-[150px] h-[150px] bg-lightest-grey">
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/products/home-pluto-mesh.jpg'); ?>" alt="" class="wp-image-1526"/>
                        </div>
                        <div class="shrink-0 w-[150px] h-[150px] bg-lightest-grey">
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/products/home-orthopaedica.jpg'); ?>" alt="" class="wp-image-1526"/>
                        </div>
                    
                </div>
            </div>

            <div class="flex flex-wrap items-center gap-sm py-xs border-b border-mid-grey | lg:flex-nowrap">
                <div class="w-full text-lg font-medium | lg:w-1/5">
                    Desks
                </div>

                <div class="w-full flex gap-sm overflow-x-scroll | lg:flex-wrap lg:w-4/5 lg:justify-end">
                    
                        <div class="shrink-0 w-[150px] h-[150px] bg-lightest-grey">
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/products/home-aspen-compact.jpg'); ?>" alt="" class="wp-image-1526"/>
                        </div>
                        <div class="shrink-0 w-[150px] h-[150px] bg-lightest-grey">
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/products/home-cade.jpg'); ?>" alt="" class="wp-image-1526"/>
                        </div>
                        <div class="shrink-0 w-[150px] h-[150px] bg-lightest-grey">
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/products/home-arise.jpg'); ?>" alt="" class="wp-image-1526"/>
                        </div>
                
                </div>
            </div>

            <div class="flex flex-wrap items-center gap-sm py-xs border-b border-mid-grey | lg:flex-nowrap">
                <div class="w-full text-lg font-medium | lg:w-1/5">
                    Storage
                </div>

                <div class="w-full flex gap-sm overflow-x-scroll | lg:flex-wrap lg:w-4/5 lg:justify-end">
                    <div class="shrink-0 w-[150px] h-[150px] bg-lightest-grey">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/products/home-pedestal.jpg'); ?>" alt="" class="wp-image-1526"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>