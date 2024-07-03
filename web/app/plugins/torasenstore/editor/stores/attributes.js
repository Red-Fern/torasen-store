import { createReduxStore, register, select } from '@wordpress/data';
import { ATTRIBUTE_STORE_NAME } from './constants';

const SET_INITIAL_DATA = 'SET_INITIAL_DATA';
const FETCH_ATTRIBUTES = 'FETCH_ATTRIBUTES';
const SELECT_ATTRIBUTE = 'SELECT_ATTRIBUTE';
const FETCH_VARIATION = 'FETCH_VARIATION';
const SET_VARIATION = 'SET_VARIATION';

const DEFAULT_STATE = {
	productId: 0,
	attributes: {},
	selectedAttributes: {},
	variation: 0,
};

const actions = {
	setInitialData: ({productId, attributes, selectedAttributes, variation }) => {
		return {
			type: SET_INITIAL_DATA,
			productId,
			attributes,
			selectedAttributes,
			variation
		}
	},

	*selectAttribute(attribute, value) {
		yield {
			type: SELECT_ATTRIBUTE,
			attribute,
			value
		}

		const variation = yield actions.fetchVariation();
		return { type: SET_VARIATION, variation };
	},

	getAttributes(productId) {
		return {
			type: FETCH_ATTRIBUTES,
			productId,
		}
	},

	fetchVariation() {
		return {
			type: FETCH_VARIATION
		}
	},

	setVariation(variation) {
		return {
			type: SET_VARIATION,
			variation
		}
	}
}

const reducer = (state = DEFAULT_STATE, action) => {
	switch (action.type) {
		case SET_INITIAL_DATA:
			return {
				...state,
				productId: action.productId,
				attributes: action.attributes,
				selectedAttributes: action.selectedAttributes,
				variation: action.variation
			}
		case SELECT_ATTRIBUTE:
			return {
				...state,
				selectedAttributes: {
					...state.selectedAttributes,
					[action.attribute]: action.value
				}
			}
		case SET_VARIATION:
			return {
				...state,
				variation: action.variation
			}
		default:
			return state;
	}
};

const selectors = {
	getProductId(state) {
		return state.productId;
	},
	getSelectedAttributes(state) {
		return state.selectedAttributes;
	},
	getSelected(state, attribute) {
		return state.selectedAttributes[attribute] ? state.selectedAttributes[attribute] : null;
	},
	getAttributes(state, productId) {
		return state.attributes;
	},
	getVariation(state) {
		return state.variation;
	}
}

const controls = {
	FETCH_ATTRIBUTES: async ({ productId }) => {
		const response = await fetch(`https://torasen-essentials.test/wp-json/torasen/v1/attributes/${productId}`);
		return await response.json();
	},
	FETCH_VARIATION: async () => {
		const attributes = await select(store).getSelectedAttributes();
		const productId = await select(store).getProductId();

		const formData = new FormData();
		formData.append('product_id', parseInt(productId));
		Object.entries(attributes).forEach(([attribute, value]) => {
			formData.append(`attribute_${attribute}`, value);
		});

		const url = wc_add_to_cart_variation_params.wc_ajax_url.toString().replace( '%%endpoint%%', 'get_variation' )
		const response = await fetch(url, {
			method: 'POST',
			body: formData
		});
		return response.json();
	}
}

const resolvers = {
	*getAttributes(productId) {
		const { attributes, defaultAttributes, variation } = yield actions.getAttributes(productId);
		return actions.setInitialData({
			productId,
			attributes,
			selectedAttributes: defaultAttributes,
			variation
		});
	},
	*getVariation() {
		const variation = yield actions.fetchVariation();
		return actions.setVariation(variation);
	}
}

const reduxStore = createReduxStore(ATTRIBUTE_STORE_NAME, {
	reducer,
	actions,
	selectors,
	controls,
	resolvers
});

register(reduxStore);


