// Register new styles

/* Button */

wp.blocks.registerBlockStyle('core/button', {
    name: 'black-fill',
    label: 'Black Fill',
    isDefault: true,
});

wp.blocks.registerBlockStyle('core/button', {
    name: 'white-fill',
    label: 'White Fill'
});

wp.blocks.registerBlockStyle('core/button', {
    name: 'black-outline',
    label: 'Black Outline'
});

// Unregister default blocks and styles

wp.domReady( function() {
    wp.blocks.unregisterBlockType('core/navigation');
});

wp.domReady( () => {
	wp.blocks.unregisterBlockStyle('core/button', 'fill');
	wp.blocks.unregisterBlockStyle('core/button', 'outline');
});