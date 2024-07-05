export default function VariationGalleryItem({ media, removeMedia }) {
	const src = media?.sizes?.thumbnail?.url;
	const alt = media?.alt;
	const imageUrl = src ? src : media?.url;

	return (
		<div className="relative border border-gray-400 shadow">
			<button
				className="bg-black absolute top-0 right-0 text-md text-white px-2 py-1"
				type="button"
				onClick={() => removeMedia(media.id)}
			>x</button>
			<img className="w-20 h-20 object-cover" src={imageUrl} alt={alt}/>
		</div>
	)
}
