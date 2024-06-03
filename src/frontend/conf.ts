import { apiEndpointType } from '../helpers/types';

export const elementId = 'page-content';


export const  apiEndpoint : apiEndpointType[] = [
	{
		method: 'POST',
		name: 'sample_post', // 'sample' is the name of the endpoint
		url: 'https://jsonplaceholder.typicode.com/posts',
		body: {
			title: 'foo',
			body: 'bar',
			userId: 1,
		},
		headers: {
			'Content-type': 'application/json; charset=UTF-8',
		},
	},
	{
		name: 'sample_get',
		method: 'GET',
		url: 'https://jsonplaceholder.typicode.com/posts',
		body: {},
		headers: {},
	},

];

export const getApiEndpoint = (name: string) => {
	return apiEndpoint.find((endpoint) => endpoint.name === name);
}
