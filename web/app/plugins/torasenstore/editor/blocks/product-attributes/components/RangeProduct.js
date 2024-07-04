export default function RangeProduct({ product }) {
	return (
		<a href={product.link} className="flex flex-col border border-gray-300">
			<span dangerouslySetInnerHTML={{ __html: product.thumbnail }}/>
			<span className="flex flex-col p-4">
				<span>{product.name}</span>
			</span>
		</a>
	)
}
