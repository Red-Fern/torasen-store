import { schema } from 'normalizr';

export const optionSchema = new schema.Entity('options',{}, {
	idAttribute: 'slug'
});

export const fieldSchema = new schema.Entity('fields', {
	options: [optionSchema]
});

