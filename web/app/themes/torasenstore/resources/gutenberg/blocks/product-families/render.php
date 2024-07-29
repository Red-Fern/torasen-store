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
                   
                    <a href="<?php echo esc_url(get_home_url() . '/product-category/torasen-essentials/seating/?_sft_productfamily=saturn'); ?>" class="block shrink-0 w-[150px] h-[150px] bg-lightest-grey">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/products/saturn.jpg'); ?>" alt="" class="wp-image-1526"/>
                    </a>
                    <a href="<?php echo esc_url(get_home_url() . '/product-category/torasen-essentials/seating/?_sft_productfamily=saturn-mesh'); ?>" class="block shrink-0 w-[150px] h-[150px] bg-lightest-grey">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/products/saturn-mesh.jpg'); ?>" alt="" class="wp-image-1526"/>
                    </a>
                    <a href="<?php echo esc_url(get_home_url() . '/product-category/torasen-essentials/seating/?_sft_productfamily=saturn-flex'); ?>" class="block shrink-0 w-[150px] h-[150px] bg-lightest-grey">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/products/saturn-flex.jpg'); ?>" alt="" class="wp-image-1526"/>
                    </a>
                    <a href="<?php echo esc_url(get_home_url() . '/product-category/torasen-essentials/seating/?_sft_productfamily=eclipse'); ?>" class="block shrink-0 w-[150px] h-[150px] bg-lightest-grey">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/products/eclipse.jpg'); ?>" alt="" class="wp-image-1526"/>
                    </a>
                    <a href="<?php echo esc_url(get_home_url() . '/product-category/torasen-essentials/seating/?_sft_productfamily=industrial'); ?>" class="block shrink-0 w-[150px] h-[150px] bg-lightest-grey">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/products/industrial.jpg'); ?>" alt="" class="wp-image-1526"/>
                    </a>
                    <a href="<?php echo esc_url(get_home_url() . '/product-category/torasen-essentials/seating/?_sft_productfamily=etcetera'); ?>" class="block shrink-0 w-[150px] h-[150px] bg-lightest-grey">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/products/etcetera.jpg'); ?>" alt="" class="wp-image-1526"/>
                    </a>
                    
                </div>
            </div>

            <div class="flex flex-wrap items-center gap-sm py-xs border-b border-mid-grey | lg:flex-nowrap">
                <div class="w-full text-lg font-medium | lg:w-1/5">
                    Desks
                </div>

                <div class="w-full flex gap-sm overflow-x-scroll | lg:flex-wrap lg:w-4/5 lg:justify-end">
                    
                    <a href="<?php echo esc_url(get_home_url() . '/product-category/torasen-essentials/desking/?_sft_productrange=aspen-compact-standalone'); ?>" class="block shrink-0 w-[150px] h-[150px] bg-lightest-grey">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/products/apsen-standalone-compact.jpg'); ?>" alt="" class="wp-image-1526"/>
                    </a>
                    <a href="<?php echo esc_url(get_home_url() . '/product-category/torasen-essentials/desking/?_sft_productrange=aspen-standalone-desk'); ?>" class="block shrink-0 w-[150px] h-[150px] bg-lightest-grey">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/products/aspen-standalone.jpg'); ?>" alt="" class="wp-image-1526"/>
                    </a>
                    <a href="<?php echo esc_url(get_home_url() . '/product-category/torasen-essentials/desking/?_sft_productrange=aspen-in-line'); ?>" class="block shrink-0 w-[150px] h-[150px] bg-lightest-grey">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/products/aspen-in-line.jpg'); ?>" alt="" class="wp-image-1526"/>
                    </a>
                    <a href="<?php echo esc_url(get_home_url() . '/product-category/torasen-essentials/desking/?_sft_productrange=aspen-back-to-back'); ?>" class="block shrink-0 w-[150px] h-[150px] bg-lightest-grey">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/products/aspen-back-to-back.jpg'); ?>" alt="" class="wp-image-1526"/>
                    </a>
                    <a href="<?php echo esc_url(get_home_url() . '/product-category/torasen-essentials/desking/?_sft_productrange=aspen-height-adjustable'); ?>" class="block shrink-0 w-[150px] h-[150px] bg-lightest-grey">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/products/aspen-height-adjustable.jpg'); ?>" alt="" class="wp-image-1526"/>
                    </a>
                    
                </div>
            </div>

            <div class="flex flex-wrap items-center gap-sm py-xs border-b border-mid-grey | lg:flex-nowrap">
                <div class="w-full text-lg font-medium | lg:w-1/5">
                    Storage
                </div>

                <div class="w-full flex gap-sm overflow-x-scroll | lg:flex-wrap lg:w-4/5 lg:justify-end">
                    
                    <a href="#" class="block shrink-0 w-[150px] h-[150px] bg-lightest-grey">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/products/aspen-pedestal.jpg'); ?>" alt="" class="wp-image-1526"/>
                    </a>
                    <a href="#" class="block shrink-0 w-[150px] h-[150px] bg-lightest-grey">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/products/aspen-storage.jpg'); ?>" alt="" class="wp-image-1526"/>
                    </a>
                    
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
                    
                    <a href="<?php echo esc_url(get_home_url() . '/product-category/torasen-essentials-home/seating-home/?_sft_productfamily=saturn'); ?>" class="block shrink-0 w-[150px] h-[150px] bg-lightest-grey">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/products/home-saturn.jpg'); ?>" alt="" class="wp-image-1526"/>
                    </a>
                    <a href="<?php echo esc_url(get_home_url() . '/product-category/torasen-essentials-home/seating-home/?_sft_productfamily=saturn-mesh'); ?>" class="block shrink-0 w-[150px] h-[150px] bg-lightest-grey">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/products/home-saturn-mesh.jpg'); ?>" alt="" class="wp-image-1526"/>
                    </a>
                    <a href="<?php echo esc_url(get_home_url() . '/product-category/torasen-essentials-home/seating-home/?_sft_productfamily=pluto-plus-mesh'); ?>" class="block shrink-0 w-[150px] h-[150px] bg-lightest-grey">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/products/home-pluto-mesh.jpg'); ?>" alt="" class="wp-image-1526"/>
                    </a>
                    <a href="<?php echo esc_url(get_home_url() . '/product-category/torasen-essentials-home/seating-home/?_sft_productfamily=orthopaedica'); ?>" class="block shrink-0 w-[150px] h-[150px] bg-lightest-grey">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/products/home-orthopaedica.jpg'); ?>" alt="" class="wp-image-1526"/>
                    </a>
                    
                </div>
            </div>

            <div class="flex flex-wrap items-center gap-sm py-xs border-b border-mid-grey | lg:flex-nowrap">
                <div class="w-full text-lg font-medium | lg:w-1/5">
                    Desks
                </div>

                <div class="w-full flex gap-sm overflow-x-scroll | lg:flex-wrap lg:w-4/5 lg:justify-end">
                    
                    <a href="<?php echo esc_url(get_home_url() . '/product-category/torasen-essentials-home/desking-home/?_sft_productrange=aspen-compact-standalone'); ?>" class="block shrink-0 w-[150px] h-[150px] bg-lightest-grey">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/products/home-aspen-compact.jpg'); ?>" alt="" class="wp-image-1526"/>
                    </a>
                    <a href="<?php echo esc_url(get_home_url() . '/product-category/torasen-essentials-home/desking-home/?_sft_productfamily=cade'); ?>" class="block shrink-0 w-[150px] h-[150px] bg-lightest-grey">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/products/home-cade.jpg'); ?>" alt="" class="wp-image-1526"/>
                    </a>
                    <a href="<?php echo esc_url(get_home_url() . '/product-category/torasen-essentials-home/desking-home/?_sft_productfamily=arise'); ?>" class="block shrink-0 w-[150px] h-[150px] bg-lightest-grey">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/products/home-arise.jpg'); ?>" alt="" class="wp-image-1526"/>
                    </a>
                
                </div>
            </div>

            <div class="flex flex-wrap items-center gap-sm py-xs border-b border-mid-grey | lg:flex-nowrap">
                <div class="w-full text-lg font-medium | lg:w-1/5">
                    Storage
                </div>

                <div class="w-full flex gap-sm overflow-x-scroll | lg:flex-wrap lg:w-4/5 lg:justify-end">
                   <a href="#" class="block shrink-0 w-[150px] h-[150px] bg-lightest-grey">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/products/home-pedestal.jpg'); ?>" alt="" class="wp-image-1526"/>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>