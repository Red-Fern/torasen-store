/**
 * WordPress dependencies
 */
import { store, getElement, getContext } from "@wordpress/interactivity";

const parent = store( 'rfAccordion' );

store( 'rfAccordionItem', {
	actions: {
		selectTab: () => {
			const context = getContext();
			parent.actions.setActiveTab(context.uniqueId);
		}
	},
	callbacks: {
		isOpen() {
			const context = getContext();
			const parentContext = getContext('rfAccordion');
			return parentContext.activeTab === context.uniqueId;
		}
	}
} );

