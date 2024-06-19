<?php 
    // Load values and assign defaults
    $layout = get_field('layout');
    $bg_image = get_field('bg_image');
    $mob_bg_image = get_field('mob_bg_image');
    $link = get_field('link');

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

<div <?php echo esc_attr($anchor); ?> class="<?php echo esc_attr( $class_name ); ?>">
    <?php if ($layout == 'image'): ?>
        <?php if ($bg_image): ?>
            <?php if ($link): ?>
                <a href="<?php echo $link['url']; ?>">
            <?php endif; ?>
                <picture>
                    <?php if ($mob_bg_image): ?>
                        <source media="(max-width: 1023px)" srcset="<?php echo $mob_bg_image['url'] ?>">
                        <source media="(min-width: 1024px)" srcset="<?php echo $bg_image['url'] ?>">
                    <?php endif; ?>

                    <img src="<?php echo $bg_image['url'] ?>" alt="<?php echo $bg_image['alt'] ?>">
                </picture>
            <?php if ($link): ?>
                </a>
            <?php endif; ?>
        <?php endif; ?>
    <?php endif; ?>
</div>