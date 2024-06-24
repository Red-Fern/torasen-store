import { useEffect } from '@wordpress/element';

export default function ProductAttributes() {

	// useEffect(() => {
	// 	fetch('https://torasenstore.com/wp-json/wp/v2/product-attributes')
	// 		.then(response => response.json())
	// 		.then(data => console.log(data));
	// })


	return (
		<div>
			{ __( 'Product Attributes – hello from the editor!', 'product-attributes' ) }
		</div>
	)
}
