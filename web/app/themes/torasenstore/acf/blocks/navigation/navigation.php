<div 
    class="navigation-block flex items-center order-last | lg:grow lg:order-none" 
    x-data="menu"
>
    <nav 
        class="w-full"
        :class="menuOpen ? 'visible opacity-100' : 'invisible opacity-0'"
        x-cloak="mobile"
    >
        <ul class="absolute top-full left-0 flex flex-col m-0 p-0 h-[calc(100vh-100%)] w-full bg-lightest-grey list-none z-10 overflow-auto | lg:static lg:flex-row lg:h-auto lg:bg-transparent">
            <?php foreach (get_field('menu_items') as $menu_item): ?>
                <li 
                    class="group <?php echo str_replace(' ', '-', strtolower($menu_item['label'])); ?> <?php echo $menu_item['link_type'] . '-item' ; ?> border-b border-mid-grey | lg:border-0" 
                    x-data="menuDropdown(<?php echo $menu_item['columns'] ? 'true' : 'false'; ?>, false)"
                >
                    <?php if (!is_admin()) : ?>
                        <!-- Menu item -->
                        <a 
                            href="<?php echo ($menu_item['link'] ? $menu_item['link']['url'] : '#'); ?>" 
                            class="link-item flex justify-between items-center px-root py-5 font-medium | lg:px-3 lg:font-normal" 
                            x-on:click="toggle"
                        >
                            <?php echo $menu_item['label']; ?>

                            <?php if ($menu_item['columns']): ?>
                                <svg xmlns="http://www.w3.org/2000/svg" class="lg:hidden" width="16" height="16" fill="none">
                                    <path fill="#000" d="M11.06 5.727 8 8.78 4.94 5.727l-.94.94 4 4 4-4-.94-.94Z" opacity=".5"/>
                                </svg>
                            <?php endif; ?>
                        </a>

                        <!-- Mega menu -->
                        <?php if ($menu_item['columns']): ?>
                            <template x-teleport="body">
                                <div
                                    class="fixed inset-0 w-full h-full bg-[rgba(95,95,95,.35)]"
                                    x-on:click="showing = !showing"
                                    x-show="showing"
                                    x-cloak
                                >
                                </div>
                            </template>

                            <div
                                class="w-full bg-light-grey text-md overflow-x-clip z-10 transition duration-500 | lg:absolute lg:top-full lg:left-0 lg:py-lg lg:bg-lightest-grey lg:shadow-lg"
                                x-cloak
                                x-show="showing"
                                @click.away="showing = false"
                            >
                                <div class="container | max-lg:p-0">
                                    <div class="lg:flex lg:gap-[10%]">
                                        <!-- Columns -->
                                        <?php foreach ($menu_item['columns'] as $column): ?>
                                            <div 
                                                class="flex flex-col border-t border-mid-grey | lg:border-0 <?php echo count($menu_item['columns']) > 1 ? 'lg:flex-1' : 'lg:w-[250px]'; ?>"
                                                x-data="menuDropdown(<?php echo $column['sub_columns'] ? 'true' : 'false'; ?>, true)"
                                            >
                                                <!-- Column heading -->
                                                <?php if ($column['title']): ?>
                                                    <div 
                                                        class="py-5 flex flex-wrap justify-between items-center gap-xs px-root | lg:mb-7 lg:p-0 lg:pb-6 lg:border-b lg:border-dark-grey <?php echo (count($column['sub_columns']) > 1 ? '' : 'hidden lg:block') ?>"
                                                        x-on:click="toggle"
                                                        :class="showing ? 'pb-0' : ''"
                                                    >
                                                        <!-- Column title -->
                                                        <div class="flex justify-between w-full font-medium | lg:w-auto">
                                                            <?php echo $column['title']; ?>

                                                            <?php if ($column['sub_columns']): ?>
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="lg:hidden" width="16" height="16" fill="none">
                                                                    <path fill="#000" d="M11.06 5.727 8 8.78 4.94 5.727l-.94.94 4 4 4-4-.94-.94Z" opacity=".5"/>
                                                                </svg>
                                                            <?php endif; ?>
                                                        </div>

                                                        <!-- Column 'view all' link/s (desktop) -->
                                                        <?php if ($column['heading_links']): ?>
                                                            <div class="hidden flex-wrap gap-x-sm gap-y-xs | lg:flex">
                                                                <?php foreach ($column['heading_links'] as $link): ?>
                                                                    <?php if ($link['link']): ?>
                                                                        <a href="<?php echo $link['link']['url']; ?>" class="block text-dark-grey" target="<?php echo $link['link']['target']; ?>">
                                                                            <?php echo $link['link']['title']; ?>
                                                                        </a>
                                                                    <?php endif; ?>
                                                                <?php endforeach; ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                <?php endif; ?>

                                                <div 
                                                    class="py-2.5 | lg:flex lg:gap-xs lg:p-0"
                                                    <?php if ($column['title'] && count($column['sub_columns']) > 1): ?>
                                                        x-show="showing"
                                                    <?php endif; ?>
                                                >
                                                    <!-- Sub columns -->
                                                    <?php foreach ($column['sub_columns'] as $sub_column): ?>
                                                        <div class="flex flex-col | lg:flex-1">
                                                            <?php if ($sub_column['title']): ?>
                                                                <div class="hidden py-5 px-root font-medium | lg:block lg:mb-3 lg:p-0">
                                                                    <?php echo $sub_column['title']; ?>
                                                                </div>
                                                            <?php endif; ?>
                                                        
                                                            <!-- Links -->
                                                            <?php if ($sub_column['links']): ?>
                                                                <ul class="m-0 p-0 px-0 | lg:space-y-3">
                                                                    <?php foreach ($sub_column['links'] as $link): ?>
                                                                        <?php if ($link['link']): ?>
                                                                            <li class="flex flex-wrap items-center gap-2">
                                                                                <a href="<?php echo $link['link']['url']; ?>" class="block px-root py-2.5 w-full text-dark-grey | lg:p-0 lg:text-black" target="<?php echo $link['link']['target']; ?>">
                                                                                    <?php echo $link['link']['title']; ?>
                                                                                </a>
                                                                            </li>
                                                                        <?php endif; ?>
                                                                    <?php endforeach; ?>

                                                                    <!-- 'View all' link -->
                                                                    <?php if ($sub_column['view_all_link']): ?>
                                                                        <li class="hidden flex-wrap items-center gap-2 | lg:flex">
                                                                            <a href="<?php echo $sub_column['view_all_link']['url']; ?>" class="block px-root py-2.5 w-full text-dark-grey | lg:p-0" target="<?php echo $sub_column['view_all_link']['target']; ?>">
                                                                                <?php echo $sub_column['view_all_link']['title']; ?>
                                                                            </a>
                                                                        </li>
                                                                    <?php endif; ?>
                                                                </ul>
                                                            <?php endif; ?>
                                                        </div>
                                                    <?php endforeach; ?>

                                                    <!-- Column 'view all' link/s (mobile) -->
                                                    <?php if ($column['heading_links']): ?>
                                                        <?php foreach ($column['heading_links'] as $link): ?>
                                                            <?php if ($link['link']): ?>
                                                                <a href="<?php echo $link['link']['url']; ?>" class="block px-root py-2.5 w-full | lg:hidden" target="<?php echo $link['link']['target']; ?>">
                                                                    <?php echo $link['link']['title']; ?>
                                                                </a>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php else: ?>
                        <!-- Static editor version of menu item -->
                        <div class="link-item px-3 py-5">
                            <?php echo $menu_item['label']; ?>
                        </div>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </nav>   

    <!-- Mobile menu toggle -->
    <button 
        class="shrink-0 flex items-center justify-center -mr-4 w-12 h-12 bg-transparent z-20 | lg:hidden" 
        <?php if (!is_admin()) : ?>
            x-on:click="toggle"
        <?php endif; ?>
    >
        <!-- Mobile menu open -->
        <svg x-show="!menuOpen" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none">
            <path fill="currentColor" d="M.8 2h14v1H.8V2Zm0 5h14v1H.8V7Zm14 5v1H.8v-1h14Z"/>
        </svg>

        <!-- Mobile menu close -->
        <svg x-cloak x-show="menuOpen" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none">
            <path fill="currentColor" d="m8.047 7.294-4.14-4.14-.707.705L7.34 8 3.2 12.14l.706.707 4.141-4.14 4.14 4.14.707-.706L8.754 8l4.14-4.14-.706-.707-4.14 4.14Z"/>
        </svg>
    </button>
</div>