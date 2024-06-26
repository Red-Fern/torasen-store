import { createReduxStore, register } from '@wordpress/data';

const SET_INITIAL_DATA = 'SET_INITIAL_DATA';
const FETCH_ATTRIBUTES = 'FETCH_ATTRIBUTES';
const SELECT_ATTRIBUTE = 'SELECT_ATTRIBUTE';
const REMOVE_ATTRIBUTE = 'REMOVE_ATTRIBUTE';

const DEFAULT_STATE = {
	attributes: {},
	selectedAttributes: {},
	variationId: 0,
};

const actions = {
	setInitialData: ({attributes, selectedAttributes, variationId }) => {
		return {
			type: SET_INITIAL_DATA,
			attributes,
			selectedAttributes,
			variationId
		}
	},

	selectAttribute(attribute, value) {
		return {
			type: SELECT_ATTRIBUTE,
			attribute,
			value
		}
	},

	removeAttribute(attribute) {
		return {
			type: REMOVE_ATTRIBUTE,
			attribute
		}
	},

	getAttributes(productId) {
		return {
			type: FETCH_ATTRIBUTES,
			productId,
		}
	}
}

const reducer = (state = DEFAULT_STATE, action) => {
	switch (action.type) {
		case SET_INITIAL_DATA:
			return {
				...state,
				attributes: action.attributes,
				selectedAttributes: action.selectedAttributes,
				variationId: action.variationId
			}
		case SELECT_ATTRIBUTE:
			return {
				...state,
				selectedAttributes: {
					...state.selectedAttributes,
					[action.attribute]: action.value
				}
			}
		case REMOVE_ATTRIBUTE:
			const { [action.attribute]: _, ...remainingAttributes } = state.selectedAttributes;
			return {
				...state,
				selectedAttributes: remainingAttributes
			};
		default:
			return state;
	}
};

const selectors = {
	getSelectedAttributes(state) {
		return state.selectedAttributes;
	},
	getSelected(state, attribute) {
		return state.selectedAttributes[attribute] ? state.selectedAttributes[attribute] : null;
	},
	getAttributes(state, productId) {
		return state.attributes;
	}
}

const controls = {
	FETCH_ATTRIBUTES: async ({ productId }) => {
		const response = await fetch(`https://torasen-essentials.test/wp-json/torasen/v1/attributes/${productId}`);
		return await response.json();
	}
}

const resolvers = {
	*getAttributes(productId) {
		const { attributes, defaultAttributes, variationId } = yield actions.getAttributes(productId);
		return actions.setInitialData({
			attributes,
			selectedAttributes: defaultAttributes,
			variationId
		});
	}
}

export const store = 'torasenstore/product-attributes';

const reduxStore = createReduxStore(store, {
	reducer,
	actions,
	selectors,
	controls,
	resolvers
});

register(reduxStore);


