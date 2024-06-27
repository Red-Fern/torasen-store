<?php 
    // Support custom "anchor" values
    $anchor = '';

    if (!empty($block['anchor'])) {
        $anchor = 'id="' . esc_attr($block['anchor']) . '" ';
    }

    // Create class attribute allowing for custom "className" and "align" values
    $class_name = 'hero-block';

    if (!empty( $block['className'])) {
        $class_name .= ' ' . $block['className'];
    }
    if (!empty( $block['align'])) {
        $class_name .= ' align' . $block['align'];
    }
?>

<?php if (have_rows('slides')): ?>
    <div <?php echo esc_attr($anchor); ?> class="<?php echo esc_attr($class_name); ?>">
        <div class="swiper" data-swiper='{
            "spaceBetween": 0,
            "autoplay": {"delay": 6000},
            "loop": true
        }'>
            <div class="swiper-wrapper">
                <?php foreach(get_field('slides') as $slide): ?>
                    <?php if ($slide['bg_image']): ?>
                        <div class="swiper-slide">
                            <a href="<?php echo $slide['link'] ? $slide['link']['url'] : '#'; ?>" class="block w-full aspect-[393/596] | md:aspect-[1739/837]">
                                <picture>
                                    <?php if ($slide['mob_bg_image']): ?>
                                        <source media="(max-width: 781px)" srcset="<?php echo $slide['mob_bg_image']['url'] ?>">
                                        <source media="(min-width: 782px)" srcset="<?php echo $slide['bg_image']['url'] ?>">
                                    <?php endif; ?>

                                    <img src="<?php echo $slide['bg_image']['url'] ?>" class="w-full !h-full object-cover" alt="<?php echo $slide['bg_image']['alt'] ?>">
                                </picture>
                            </a>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php elseif ($is_preview): ?>
    <div class="px-root">
        <div class="p-xs w-full border border-mid-grey text-dark-grey text-center">Slides will be displayed in a scrollable list once added.</div>
    </div>
<?php endif; ?>