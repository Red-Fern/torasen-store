/** @type {import('tailwindcss').Config} */
import path from 'path';
const contentPath = path.resolve(__dirname, './components/**/*.js');

module.exports = {
	content: [
		contentPath
	],
	corePlugins: {
		preflight: false,
	},
	theme: {
		extend: {},
	},
	plugins: [],
}
