export default function RangeProduct({ product }) {
	return (
		<a href={product.link} className="flex flex-col">
			<span class="border border-dark-grey slide-product-thumbnial has-lightest-grey-background-color" dangerouslySetInnerHTML={{ __html: product.thumbnail }}/>
			<span className="flex flex-col pt-4">
				<span className="font-medium">{product.name}</span>
			</span>
		</a>
	)
}
