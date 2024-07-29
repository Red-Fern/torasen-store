import { Dialog, DialogPanel, DialogBackdrop, DialogTitle, Description } from "@headlessui/react";
import { useState } from "@wordpress/element";

export default function HelpPanel({ title, content }) {
	let [isOpen, setIsOpen] = useState(false)

	return (
		<>
			<button className="bg-transparent p-1 border border-black rounded-full" onClick={() => setIsOpen(true)}>
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
					className="fixed inset-0 bg-[rgba(95,95,95,.35)] duration-300 ease-out data-[closed]:opacity-0"
				/>

				<div className="fixed inset-0 w-full h-full">
					<DialogPanel
						transition
						className="fixed top-0 right-0 w-[480px] max-w-full h-full overflow-y-scroll bg-white duration-300 ease-out data-[closed]:translate-x-full"
					>
						<DialogTitle
							as="div"
							className="flex items-center jusify-between gap-md px-lg py-xs border-b border-mid-grey">
							<div className="grow font-medium">
								<span>{title}</span>
							</div>
							<button
								onClick={() => setIsOpen(false)}
								className="flex items-center justify-center w-[46px] h-[46px] bg-black"
							>
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none">
									<path fill="#fff" d="m8.046 7.294-4.14-4.14-.707.705L7.34 8 3.2 12.14l.706.707 4.141-4.14 4.14 4.14.707-.706L8.753 8l4.14-4.14-.706-.707-4.14 4.14Z"/>
								</svg>
							</button>
						</DialogTitle>

						<div className="px-lg py-sm" dangerouslySetInnerHTML={{__html: content}}></div>
					</DialogPanel>
				</div>
			</Dialog>
		</>
	)
}
