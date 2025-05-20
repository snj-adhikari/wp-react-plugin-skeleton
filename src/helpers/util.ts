export const debugLog = (() => {
	let debugModeLogged = false;
	return (
		message: object | string | any[],
		detail?: object | boolean | number | string | any[],
		error = false
	) => {
		const params = new URLSearchParams(window.location.search);
		if (params.get('am_aredeal_debug') === 'true') {
			if (!debugModeLogged) {
				console.log(
					'%cDebug mode is enabled',
					'color: purple',
					'Aremedia Aredeals Plugin'
				);
				debugModeLogged = true;
			}
			if (Array.isArray(message)) {
				console.table(message);
			} else if (error) {
				console.error(message, detail);
			} else {
				console.log(message, detail || '');
			}
		}
	};
})();