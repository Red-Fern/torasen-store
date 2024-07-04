import { createReduxStore, register } from '@wordpress/data';
import { normalize } from "normalizr";
import {fieldSchema} from "./schema";
import { EXTRA_STORE_NAME } from './constants';

const DEFAULT_STATE = {
	fields: {},
	options: {},
	selectedOptions: []
}

const actions = {
	setFields({ fields, options }) {
		return {
			type: 'SET_OPTIONS',
			fields,
			options
		}
	},
	getFields(productId) {
		return {
			type: 'FETCH_FIELDS',
			productId
		}
	},
	selectOption(option) {
		return {
			type: 'SELECT_OPTION',
			option
		}
	}
}

const reducer = (state = DEFAULT_STATE, action) => {
	switch (action.type) {
		case 'SET_OPTIONS':
			return {
				...state,
				fields: action.fields,
				options: action.options
			}
		case 'SELECT_OPTION':
			return {
				...state,
				selectedOptions: state.selectedOptions.includes(action.option) ?
					state.selectedOptions.filter(option => option !== action.option) :
					[...state.selectedOptions, action.option]
			}
		default:
			return state;
	}
}

const selectors = {
	getFields(state) {
		return state.fields;
	},
	getOptions(state, fieldId) {
		return state.fields[fieldId].options.map(optionId => state.options[optionId]);
	},
	isSelected(state, optionId) {
		return state.selectedOptions.includes(optionId);
	},
	getSelectedOptions(state) {
		return state.selectedOptions;
	},
	getSelectedPrices(state) {
		return state.selectedOptions.reduce((total, optionId) => total + state.options[optionId].pricing_amount, 0);
	}
}

const controls = {
	async FETCH_FIELDS({ productId }) {
		const response = await fetch(`/wp-json/torasen/v1/extras/${productId}`);
		return await response.json();
	}
}


const resolvers = {
	*getFields(productId) {
		const {fields} = yield actions.getFields(productId);

		const { entities } = normalize(fields, [fieldSchema]);

		return actions.setFields(entities);
	}
}

export const storeInstance = createReduxStore(EXTRA_STORE_NAME, {
	reducer,
	actions,
	selectors,
	controls,
	resolvers
});

register(storeInstance);
