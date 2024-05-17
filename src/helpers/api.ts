import { QueryParamTypes } from "./types";

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
