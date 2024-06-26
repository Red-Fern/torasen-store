import { Dialog, DialogPanel, DialogBackdrop, DialogTitle, Description } from "@headlessui/react";
import { useState } from "@wordpress/element";

export default function HelpPanel({ content }) {
	let [isOpen, setIsOpen] = useState(false)

	return (
		<>
			<button onClick={() => setIsOpen(true)}>Open dialog</button>
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
						<DialogTitle className="font-bold py-6 px-12 border-b border-black flex justify-between items-center">
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
