import { QueryParamTypes } from "./types";

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

export const sendPostRequest = async (
	url: string,
	data: any,
	headers: any = {}
): Promise<any> => {
	return fetch(url, {
		method: 'POST',
		headers: {
			...headers,
			'Content-Type': 'application/json',
		},
		body: JSON.stringify(data),
	});
};

export const sendGetRequest = async (
	url: string,
	query: QueryParamTypes = {},
	headers: any = {}
): Promise<{ data: any; header: any }> => {
	const queryString = new URLSearchParams(query as any).toString();
	const requestUrl = `${url}?${queryString}`;

	const response = await fetch(requestUrl, {
		method: 'GET',
		headers: {
			...headers,
			'Content-Type': 'application/json',
		},
	});

	const data = await response.json();
	const header = response.headers;
	return { data, header };
};
