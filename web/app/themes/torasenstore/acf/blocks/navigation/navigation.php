<div 
    class="navigation-block flex items-center order-last | lg:grow lg:order-none" 
    x-data="menu"
>
    <nav 
        class="w-full"
        :class="menuOpen ? 'visible opacity-100' : 'invisible opacity-0'"
        x-cloak
    >
        <ul class="absolute top-full left-0 flex flex-col m-0 p-0 h-[calc(100vh-100%)] w-full bg-lightest-grey list-none z-10 overflow-auto | lg:static lg:flex-row lg:h-auto lg:bg-transparent">
            <?php foreach (get_field('menu_items') as $menu_item): ?>
                <li 
                    class="group <?php echo str_replace(' ', '-', strtolower($menu_item['label'])); ?> <?php echo $menu_item['link_type'] . '-item' ; ?> border-b border-mid-grey | lg:border-0" 
                    x-data="menuDropdown(<?php echo $menu_item['columns'] ? 'true' : 'false'; ?>)"
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
                            <div
                                x-cloak
                                x-show="showing"
                                class="w-full bg-light-grey text-md overflow-x-clip z-10 transition duration-500 | lg:absolute lg:top-full lg:left-0 lg:py-lg lg:bg-lightest-grey lg:shadow-lg lg:invisible lg:opacity-0 lg:hover:visible lg:hover:opacity-100 lg:group-hover:visible lg:group-hover:opacity-100"
                            >
                                <div class="container | max-lg:p-0">
                                    <div class="lg:flex lg:gap-[10%]">
                                        <!-- Columns -->
                                        <?php foreach ($menu_item['columns'] as $column): ?>
                                            <div 
                                                class="flex flex-col border-t border-mid-grey | lg:border-0 <?php echo count($menu_item['columns']) > 1 ? 'lg:flex-1' : 'lg:w-[250px]'; ?>"
                                                x-data="menuDropdown(<?php echo $column['sub_columns'] ? 'true' : 'false'; ?>)"
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

                                                        <!-- Column 'view all' link/s -->
                                                        <?php if ($column['heading_links']): ?>
                                                            <div class="hidden flex-wrap gap-xs | lg:flex">
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
        class="py-5 bg-transparent z-20 | lg:hidden" 
        <?php if (!is_admin()) : ?>
            x-on:click="toggle"
        <?php endif; ?>
    >
        <!-- Mobile menu open -->
        <svg x-show="!menuOpen" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor">
            <path d="M3 18H21V16H3V18ZM3 13H21V11H3V13ZM3 6V8H21V6H3Z"></path>
        </svg>

        <!-- Mobile menu close -->
        <svg x-cloak x-show="menuOpen" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
        </svg>
    </button>
</div>