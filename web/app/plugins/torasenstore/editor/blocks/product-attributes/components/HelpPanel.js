import { Dialog, DialogPanel, DialogBackdrop, DialogTitle, Description } from "@headlessui/react";
import { useState } from "@wordpress/element";

export default function HelpPanel({ content }) {
	let [isOpen, setIsOpen] = useState(false)

	return (
		<>
			<button onClick={() => setIsOpen(true)}>Open dialog</button>
			<Dialog open={isOpen} onClose={() => setIsOpen(false)} className="relative z-50">
				<DialogBackdrop className="fixed inset-0 bg-black bg-opacity-50" />

				<div className="fixed inset-0 flex w-screen items-center justify-center p-4">
					<DialogPanel className="max-w-lg space-y-4 border bg-white p-12">
						<DialogTitle className="font-bold">Deactivate account</DialogTitle>
						<div dangerouslySetInnerHTML={{ __html: content }}></div>
						<div className="flex gap-4">
							<button onClick={() => setIsOpen(false)}>Cancel</button>
							<button onClick={() => setIsOpen(false)}>Deactivate</button>
						</div>
					</DialogPanel>
				</div>
			</Dialog>
		</>
	)
}
