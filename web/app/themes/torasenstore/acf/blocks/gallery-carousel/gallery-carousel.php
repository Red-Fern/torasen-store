<?php 
    // Support custom "anchor" values
    $anchor = '';

    if (!empty($block['anchor'])) {
        $anchor = 'id="' . esc_attr($block['anchor']) . '" ';
    }

    // Create class attribute allowing for custom "className" and "align" values
    $class_name = 'gallery-carousel-block';

    if (!empty( $block['className'])) {
        $class_name .= ' ' . $block['className'];
    }
    if (!empty( $block['align'])) {
        $class_name .= ' align' . $block['align'];
    }
?>

<?php if (have_rows('slides')): ?>
    <div <?php echo esc_attr($anchor); ?> class="<?php echo esc_attr($class_name); ?>">
        <div class="container">
            <div class="swiper right-bleed" data-swiper='{
                "slidesPerView": "auto",
                "slidesPerGroup": 1
            }'>
                <div class="swiper-wrapper">
                    <?php foreach(get_field('slides') as $slide): ?>
                        <div class="swiper-slide !w-[90%] space-y-xs | md:!w-[460px]">
                            <?php if ($slide['image'] || $slide['video']): ?>
                                <div class="block w-full aspect-[460/520]">
                                    <?php if ($slide['media'] == 'image' && $slide['image']): ?>
                                        <img src="<?php echo $slide['image']['url'] ?>" class="w-full h-full object-cover" alt="<?php echo $slide['image']['alt'] ?>">
                                    <?php endif; ?>

                                    <?php if ($slide['media'] == 'video' && $slide['video']): ?>
                                        <video class="w-full h-full object-cover" playsinline="playsinline" preload="metadata" muted autoplay loop crossorigin="anonymous">
                                            <source src="<?php echo $slide['video']['url'] ?>" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>

                            <?php if ($slide['text']): ?>
                                <div class="space-y-2">
                                    <?php echo $slide['text']; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
<?php elseif ($is_preview): ?>
    <div class="px-root">
        <div class="p-xs w-full border border-mid-grey text-dark-grey text-center">Slides will be displayed in a scrollable list once added.</div>
    </div>
<?php endif; ?>