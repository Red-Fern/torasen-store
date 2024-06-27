<?php 
    // Load values and assign defaults
    $layout = get_field('layout');
    $media = get_field('media');
    $image = get_field('image');
    $video = get_field('video');
    $poster = get_field('video_poster_image');

    // Support custom "anchor" values
    $anchor = '';

    if (!empty($block['anchor'])) {
        $anchor = 'id="' . esc_attr($block['anchor']) . '" ';
    }

    // Create class attribute allowing for custom "className" and "align" values
    $class_name = 'text-media-block';

    if (!empty($block['className'])) {
        $class_name .= ' ' . $block['className'];
    }
    if (!empty($block['align'])) {
        $class_name .= ' align' . $block['align'];
    }

    $wrapper_attributes = get_block_wrapper_attributes(['class' => $class_name]); 

    $template = [
        [ 
            'core/heading', 
            [
                'level' => 2,
                'placeholder' => 'Mauris eu enim ornare, gravida mauris aliquam. Volutpat felis, Vivamus interdum quam felis.'
            ],
        ],
        [
            'core/group',
            [],
            [
                [
                    'core/paragraph',
                    [
                        'placeholder' => 'Donec consectetur nisl ex, vitae volutpat odio placerat mollis. Proin et elit non ex maximus volutpat ornare vitae diam. Phasellus hendrerit sem quis massa rhoncus, ut consectetur lacus porta. Donec consectetur nisl ex, vitae volutpat odio placerat mollis. Proin et elit non ex maximus volutpat ornare vitae diam. Phasellus hendrerit sem quis massa rhoncus, ut consectetur lacus porta'
                    ]
                ],
                [
                    'core/buttons',
                    [],
                    [
                        [
                            'core/button'
                        ]
                    ]
                ]
            ]
        ]
    ];
?>

<div <?php echo esc_attr($anchor); ?> <?php echo $wrapper_attributes; ?>>
    <div class="container flex flex-wrap gap-lg | lg:flex-nowrap lg:justify-between lg:gap-0 <?php echo ($layout == 'media-right' ? 'lg:flex-row-reverse' : ''); ?>">
        <div class="w-full | lg:w-1/2">
            <div class="aspect-[1/0.8]">
                <?php if ($media == 'image' && $image): ?>
                    <img src="<?php echo $image['url'] ?>" class="w-full h-full object-cover" alt="<?php echo $image['alt'] ?>">
                <?php endif; ?>

                <?php if ($media == 'video' && $video): ?>
                    <div class="relative w-full h-full">
                        <video class="absolute inset-0 w-full h-full object-cover" playsinline="playsinline" preload="metadata" muted autoplay loop crossorigin="anonymous">
                            <source src="<?php echo $video['url'] ?>" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>

                        <?php if ($poster): ?>
                            <button class="video-button absolute inset-0 w-full h-full object-cover" aria-label="Play video">
                                <img src="<?php echo $poster['url'] ?>" class="w-full h-full object-cover" alt="<?php echo $poster['alt'] ?>">
                            </button>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="flex w-full | lg:w-[calc(50%-var(--wp--preset--spacing--xxl))]">
            <InnerBlocks template="<?php echo esc_attr(wp_json_encode($template)); ?>" class="flex flex-col justify-between" />
        </div>
    </div>
</div>