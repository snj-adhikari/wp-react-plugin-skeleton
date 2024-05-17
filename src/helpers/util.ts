// Function to retrieve all URLs from a specific HTML element
export const retrieveUrlsFromElement = (elementId: string): string[] => {
	const element = document.getElementById(elementId);
	if (element) {
		const urls = Array.from(element.getElementsByTagName('a')).map(
			(a) => a.href
		);
		return urls;
	}
	return [];
};
