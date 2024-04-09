export const fetchPosts = async () => {
	try {
		const response = await fetch('https://jsonplaceholder.typicode.com/posts');
		if (!response.ok) {
			throw new Error('Error fetching posts');
		}
		const data = await response.json();
		return data;
	} catch (error) {
		console.error('Error fetching posts:', error);
		throw error;
	}
};
