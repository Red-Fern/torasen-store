import RangeProduct from "./RangeProduct";

export default function RangeSlider({ products }) {
	return (
		<div className="flex gap-4">
			{products.map((product) => (
				<RangeProduct key={product.id} product={product} />
			))}
		</div>
	)
}
