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
                    [ Category ]
                </div>

                <div class="w-full flex gap-sm overflow-x-scroll | lg:flex-wrap lg:w-4/5 lg:justify-end">
                    <?php for ($i = 0; $i < 6; $i++): ?>
                        <div class="shrink-0 w-[150px] h-[150px] bg-lightest-grey"></div>
                    <?php endfor; ?>
                </div>
            </div>

            <div class="flex flex-wrap items-center gap-sm py-xs border-b border-mid-grey | lg:flex-nowrap">
                <div class="w-full text-lg font-medium | lg:w-1/5">
                    [ Category ]
                </div>

                <div class="w-full flex gap-sm overflow-x-scroll | lg:flex-wrap lg:w-4/5 lg:justify-end">
                    <?php for ($i = 0; $i < 5; $i++): ?>
                        <div class="shrink-0 w-[150px] h-[150px] bg-lightest-grey"></div>
                    <?php endfor; ?>
                </div>
            </div>

            <div class="flex flex-wrap items-center gap-sm py-xs border-b border-mid-grey | lg:flex-nowrap">
                <div class="w-full text-lg font-medium | lg:w-1/5">
                    [ Category ]
                </div>

                <div class="w-full flex gap-sm overflow-x-scroll | lg:flex-wrap lg:w-4/5 lg:justify-end">
                    <?php for ($i = 0; $i <= 2; $i++): ?>
                        <div class="shrink-0 w-[150px] h-[150px] bg-lightest-grey"></div>
                    <?php endfor; ?>
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
                    [ Category ]
                </div>

                <div class="w-full flex gap-sm overflow-x-scroll | lg:flex-wrap lg:w-4/5 lg:justify-end">
                    <?php for ($i = 0; $i < 4; $i++): ?>
                        <div class="shrink-0 w-[150px] h-[150px] bg-lightest-grey"></div>
                    <?php endfor; ?>
                </div>
            </div>

            <div class="flex flex-wrap items-center gap-sm py-xs border-b border-mid-grey | lg:flex-nowrap">
                <div class="w-full text-lg font-medium | lg:w-1/5">
                    [ Category ]
                </div>

                <div class="w-full flex gap-sm overflow-x-scroll | lg:flex-wrap lg:w-4/5 lg:justify-end">
                    <?php for ($i = 0; $i < 3; $i++): ?>
                        <div class="shrink-0 w-[150px] h-[150px] bg-lightest-grey"></div>
                    <?php endfor; ?>
                </div>
            </div>

            <div class="flex flex-wrap items-center gap-sm py-xs border-b border-mid-grey | lg:flex-nowrap">
                <div class="w-full text-lg font-medium | lg:w-1/5">
                    [ Category ]
                </div>

                <div class="w-full flex gap-sm overflow-x-scroll | lg:flex-wrap lg:w-4/5 lg:justify-end">
                    <div class="shrink-0 w-[150px] h-[150px] bg-lightest-grey"></div>
                </div>
            </div>
        </div>
    </div>
</div>