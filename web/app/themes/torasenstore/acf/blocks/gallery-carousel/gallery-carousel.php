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
                "slidesPerGroup": 1,
                "navigation": {
                    "nextEl": ".swiper-button-next",
                    "prevEl": ".swiper-button-prev"
                }
            }'>
                <div class="container flex flex-wrap gap-md items-center | md:flex-nowrap">
                    <?php if (get_field('title')) : ?>
                        <h2 class="mb-0 w-full | md:w-auto"><?php echo get_field('title'); ?></h2>
                    <?php endif; ?>

                    <div class="flex gap-2 | md:ml-auto">
                        <button class="swiper-button-prev p-0 w-11 h-11 rounded-full border border-black bg-transparent flex items-center justify-center" aria-label="Previous slide">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17" viewBox="0 0 16 17" fill="none">
                                <path d="M1.15391 7.83774L0.800781 8.19087L1.15391 8.54399L6.40391 13.794L6.75703 14.1471L7.46328 13.4409L7.11016 13.0877L2.71328 8.69087H14.257H14.757V7.69087H14.257H2.71328L7.11016 3.29399L7.46328 2.94087L6.75703 2.23462L6.40391 2.58774L1.15391 7.83774Z" fill="#1D1D1B"/>
                            </svg>
                        </button>

                        <button class="swiper-button-next p-0 w-11 h-11 rounded-full border border-black bg-transparent flex items-center justify-center" aria-label="Next slide">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17" viewBox="0 0 16 17" fill="none">
                                <path d="M14.4039 8.54399L14.757 8.19087L14.4039 7.83774L9.15391 2.58774L8.80078 2.23462L8.09453 2.94087L8.44766 3.29399L12.8445 7.69087H1.30078H0.800781V8.69087H1.30078H12.8445L8.44766 13.0877L8.09453 13.4409L8.80078 14.1471L9.15391 13.794L14.4039 8.54399Z" fill="#1D1D1B"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="swiper-wrapper mt-sm">
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