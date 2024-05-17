module.exports = {
	'*.{css,sass,scss}': 'npm run lint:css',
	'*.{ts,tsx}': 'npm run lint:ts',
	'*.php': () => 'npm run lint:php', // Don't pass changed files to PHP linter or it will use all rulesets for them.
};
