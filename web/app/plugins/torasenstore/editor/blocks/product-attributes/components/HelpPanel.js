import { Dialog, DialogPanel, DialogBackdrop, DialogTitle, Description } from "@headlessui/react";
import { useState } from "@wordpress/element";

export default function HelpPanel({ content }) {
	let [isOpen, setIsOpen] = useState(false)

	return (
		<>
			<button className="bg-transparent p-2 border border-black rounded-full" onClick={() => setIsOpen(true)}>
				<svg className="w-3 h-3 text-black" viewBox="0 0 10 11" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
					<path d="M3.5625 3.625C3.5625 2.93555 4.12305 2.375 4.8125 2.375H5.4375C6.12695 2.375 6.6875 2.93555 6.6875 3.625V3.80664C6.6875 4.18945 6.51172 4.55273 6.20898 4.78906L4.73828 5.94531L4.5 6.13281V6.4375V7.375H5.75V6.74219L6.98242 5.77344C7.58594 5.29883 7.9375 4.57422 7.9375 3.80664V3.625C7.9375 2.24414 6.81836 1.125 5.4375 1.125H4.8125C3.43164 1.125 2.3125 2.24414 2.3125 3.625V3.9375H3.5625V3.625ZM5.90625 8.3125H4.34375V9.875H5.90625V8.3125Z"/>
				</svg>
			</button>
			<Dialog
				open={isOpen}
				onClose={() => setIsOpen(false)}
				className="relative z-50"
			>
				<DialogBackdrop
					transition
					className="fixed inset-0 bg-black/50 duration-300 ease-out data-[closed]:opacity-0"
				/>

				<div className="fixed h-full top-0 right-0">
					<DialogPanel
						transition
						className="max-w-lg h-full overflow-y-scroll bg-white duration-300 ease-out data-[closed]:translate-x-full"
					>
						<DialogTitle
							className="font-bold py-6 px-12 border-b border-black flex justify-between items-center">
							<span>Deactivate account</span>
							<button
								onClick={() => setIsOpen(false)}
								className="p-2 bg-black"
							>
								<svg className="w-5 h-5 text-white" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
									<path d="M8.04609 7.2937L3.90547 3.15308L3.19922 3.85933L7.33984 7.99995L3.19922 12.1406L3.90547 12.8468L8.04609 8.7062L12.1867 12.8468L12.893 12.1406L8.75234 7.99995L12.893 3.85933L12.1867 3.15308L8.04609 7.2937Z"/>
								</svg>
							</button>
						</DialogTitle>
						<div className="py-8 px-12" dangerouslySetInnerHTML={{__html: content}}></div>
					</DialogPanel>
				</div>
			</Dialog>
		</>
	)
}
