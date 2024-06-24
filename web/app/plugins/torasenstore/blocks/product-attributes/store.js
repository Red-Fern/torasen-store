import apiFetch from '@wordpress/api-fetch';
import { createReduxStore, register } from '@wordpress/data';

// Initial state
const DEFAULT_STATE = {
	count: 0,
};

// Actions
const INCREMENT = 'INCREMENT';
const DECREMENT = 'DECREMENT';

export const increment = () => ({
	type: INCREMENT,
});

export const decrement = () => ({
	type: DECREMENT,
});

// Reducer
const reducer = (state = DEFAULT_STATE, action) => {
	switch (action.type) {
		case INCREMENT:
			return {
				...state,
				count: state.count + 1,
			};
		case DECREMENT:
			return {
				...state,
				count: state.count - 1,
			};
		default:
			return state;
	}
};

// Register store
export const store = createReduxStore('my-custom-store', {
	reducer,
	actions: {
		increment,
		decrement,
	},
	selectors: {
		getCount(state) {
			return state.count;
		},
	},
});

register(store);
