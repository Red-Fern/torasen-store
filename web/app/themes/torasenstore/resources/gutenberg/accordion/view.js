/**
 * WordPress dependencies
 */
import { store, getContext } from "@wordpress/interactivity";

store( 'rfAccordion', {
	actions: {
		setActiveTab: (activeTab) => {
			const context = getContext();
			context.activeTab = context.activeTab === activeTab ? null : activeTab;
		},
	}
} );

