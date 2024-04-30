// Register new styles

/* Button */

wp.blocks.registerBlockStyle('core/button', {
    name: 'black-fill',
    label: 'Black Fill',
    isDefault: true,
});

wp.blocks.registerBlockStyle('core/button', {
    name: 'white-fill',
    label: 'White Fill',
    isDefault: true,
});

wp.blocks.registerBlockStyle('core/button', {
    name: 'black-outline',
    label: 'Black Outline',
    isDefault: true,
});

// Unregister default styles

wp.domReady( () => {
	wp.blocks.unregisterBlockStyle('core/button', 'fill');
	wp.blocks.unregisterBlockStyle('core/button', 'outline');
});