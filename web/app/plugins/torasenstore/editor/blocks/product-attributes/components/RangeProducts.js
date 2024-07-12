import { useState, useEffect } from '@wordpress/element';
import HelpPanel from "./HelpPanel";
import RangeSlider from "./RangeSlider";

export default function RangeProducts({ productId }) {
	const [range, setRange] = useState('');
	const [rangeProducts, setRangeProducts] = useState([]);
	const [isOpen, setIsOpen] = useState(false);

	useEffect(() => {
		async function loadProductRange() {
			try {
				const response = await fetch(`/wp-json/torasen/v1/range/${productId}`);
				const { range, description, products } = await response.json();
				setRange(range);
				setRangeProducts(products);
			} catch (error) {
				console.error(error);
			}
		}

		loadProductRange();
	}, []);

	const openRange = () => {
		setIsOpen(!isOpen);
	}

	return (
		<div className="flex flex-col gap-3 w-full pb-4 border-b border-gray-300">
			<div className="flex flex-col gap-3 w-full | md:flex-row">
				<div className="md:w-1/4">
					<div className="flex items-center gap-2">
						<span className="font-medium">Product Range</span>
					</div>
				</div>
				<div className="md:w-3/4 flex gap-2">
					<div
						className={`flex items-center bg-white border border-gray-300`}
					>
						<span className="block py-3 px-4">{range}</span>
					</div>

					<button
						type="button"
						className={`flex items-center border border-gray-300 hover:bg-white`}
						onClick={() => openRange()}
					>
						<span className="block py-3 px-4 border-r border-gray-300">{isOpen ? 'Close' : 'Switch'}</span>
						<span className="py-3 px-4">
							{isOpen ? (
								<svg className="w-6 h-6 fill-[#6C6C65]" xmlns="http://www.w3.org/2000/svg" width="17" height="16" viewBox="0 0 17 16" fill="currentColor">
									<path d="M8.54609 7.29395L4.40547 3.15332L3.69922 3.85957L7.83984 8.0002L3.69922 12.1408L4.40547 12.8471L8.54609 8.70645L12.6867 12.8471L13.393 12.1408L9.25234 8.0002L13.393 3.85957L12.6867 3.15332L8.54609 7.29395Z"/>
								</svg>
							) : (
								<svg className="w-6 h-6 fill-[#6C6C65]" xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17" fill="currentColor">
									<path d="M15.5 1.50012V4.50012H14.5H13.5H12.5V1.50012H15.5ZM12.5 5.50012H13.5V10.5001C13.5 11.8814 12.3813 13.0001 11 13.0001H8.79375L10.5875 11.3689L9.91562 10.6282L7.16563 13.1282L6.75938 13.497L7.16563 13.8657L9.91562 16.3657L10.5875 15.6251L8.79375 14.0001H11C12.9344 14.0001 14.5 12.4345 14.5 10.5001V5.50012H15.5H16.5V4.50012V1.50012V0.500122H15.5H12.5H11.5V1.50012V4.50012V5.50012H12.5ZM7.0875 0.631372L6.4125 1.36887L8.20625 3.00012H6C4.06562 3.00012 2.5 4.56575 2.5 6.50012V11.5001H1.5H0.5V12.5001V15.5001V16.5001H1.5H4.5H5.5V15.5001V12.5001V11.5001H4.5H3.5V6.50012C3.5 5.11887 4.61875 4.00012 6 4.00012H8.20625L6.4125 5.63137L7.08437 6.372L9.83438 3.872L10.2406 3.50325L9.83438 3.1345L7.08437 0.634497L7.0875 0.631372ZM2.5 12.5001H3.5H4.5V15.5001H1.5V12.5001H2.5Z"/>
								</svg>
							)}
						</span>
					</button>
				</div>
			</div>
			{isOpen && (
				<RangeSlider products={rangeProducts} />
			)}
		</div>
	)
}
